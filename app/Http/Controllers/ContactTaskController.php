<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\ContactTask;
use App\Contact;
use App\User;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'contacts';
            $with_permission = UserHelper::checkUserRole($group_id, $module); 
            if(!$with_permission) {
                Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                Session::flash('alert_class', 'alert-danger');                
                return redirect('dashboard');
            }    

            return $next($request);     
        });                 
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'title'      => 'required',
                'due_date'   => 'required'
             ]);

            $assigned_user = serialize($request->input('assigned_user'));

            $contact_id = $request->input('contact_id');
            $contact_id = Hashids::decode($contact_id)[0];

            $user_id  = Auth::user()->id;
            $contact_task               = new ContactTask;
            $contact_task->user_id       = $user_id; //This is for created by
            $contact_task->contact_id    = $contact_id;
            $contact_task->assigned_user = $assigned_user;
            $contact_task->title         = $request->input('title');
            $contact_task->notes         = $request->input('notes');
            $contact_task->due_date      = $request->input('due_date');
            $contact_task->status        = "pending"; //pending, in_progress, completed, closed
            $contact_task->save();

            /*
			 * Send notification
            */
            $is_enable_email = true;
            if($is_enable_email) {}
            /*
			 * Send notification - end
            */

            Session::flash('message', 'You have successfully created task');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();

        }else{
            Session::flash('message', 'Unable to create new task');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();
        }
    }  

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'title'      => 'required',
                'due_date'   => 'required'
             ]);

            $id = Hashids::decode($request->input('id'))[0];
            $contact_task = ContactTask::find($id);

			$assigned_user = serialize($request->input('assigned_user'));            

            if($contact_task) {
	            $contact_task->assigned_user = $assigned_user;
	            $contact_task->title         = $request->input('title');
	            $contact_task->notes         = $request->input('notes');
	            $contact_task->due_date      = $request->input('due_date');
	            $contact_task->status        = $request->input('status'); //pending, in_progress, completed, closed
                $contact_task->save();

                Session::flash('message', 'Task has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();
            }
        }

        Session::flash('message', 'Unable to update Task');
        Session::flash('alert_class', 'alert-danger');
        return redirect()->back();
    }         

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $task = ContactTask::find($id);

            if($task) {   
                $task->delete();
                Session::flash('message', "Task Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();
            }
        }
    }     

}
