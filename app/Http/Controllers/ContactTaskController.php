<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\ContactHistory;
use App\ContactTask;
use App\Contact;
use App\User;

use UserHelper;
use GlobalHelper;

use App\Mail\TaskNotification;

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

            $pending_task_count = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->count();
            $pending_task       = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->get();

            $idl_contacts = UserHelper::getIdleContacts();
            $idle_contacts_count = 0;
            $idle_contacts       = array();
            if(!empty($idl_contacts)) {
                $idle_contacts_count = $idl_contacts['total_idle'];
                $idle_contacts       = $idl_contacts['idle_data'];
            }

            View::share ( 'idle_contacts_count', $idle_contacts_count );   
            View::share ( 'idle_contacts', $idle_contacts);                   

            View::share ( 'pending_task_count', $pending_task_count );   
            View::share ( 'pending_task', $pending_task);   

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
            $contact_task->assigned_user_id = $request->input('assigned_user');
            $contact_task->assigned_user = $assigned_user;
            $contact_task->title         = $request->input('title');
            $contact_task->notes         = $request->input('notes');
            $contact_task->due_date      = $request->input('due_date');
            $contact_task->status        = "pending"; //pending, in_progress, completed, closed
            $contact_task->save();

            /*
			 * Send notification
            */
            $is_enable_email = GlobalHelper::enable_mail_function();
            if($is_enable_email) {        	

	            if(is_array($request->input('assigned_user'))) {
	            	//To do: for multiple assiged user in the future
	            } else {
	            	$user_id = $request->input('assigned_user');
	            	$a_user = User::find($user_id);
	            	if ($a_user->count()) { 

			            $name    	= Auth::user()->firstname . " " . Auth::user()->lastname;
			            $to_email   = $a_user->email;
			            $from_email = 'admin@coreCRM.coms';
			            $subject 	= 'New Task Notification';
			            $message 	= "You have new task assigned to you, due date is on " . date("F j, Y", strtotime($contact_task->due_date)) . "."; 
			            $message    .= "<br />Task No.: " . $contact_task->id;   

			            Mail::to($to_email)
			                ->send(new TaskNotification($name, $to_email, $from_email, $subject, $message)); 
	            	}
	            }   
	            	
            }
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
            	$contact_task->assigned_user_id = $request->input('assigned_user');
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
