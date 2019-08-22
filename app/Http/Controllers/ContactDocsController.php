<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\ContactDocs;
use App\ContactTask;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;


class ContactDocsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');       
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'settings';
            $with_permission = UserHelper::checkUserRole($group_id, $module); 
            if(!$with_permission) {
                Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                Session::flash('alert_class', 'alert-danger');                
                return redirect('dashboard');
            }    

            $pending_task_count = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->count();
            $pending_task       = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->get();

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
                'document_title'           => 'required',
                'filename' => 'required',
                'document_type' => 'required',
                'description' => 'required'
             ]);

            $user_id = Auth::user()->id;

            $contactDoc              	= new ContactDocs;
            $contactDoc->user_id        = $user_id;
            $contactDoc->filename       = $request->input('name');
            $contactDoc->contact_id     = $request->input('contact_id');
            $contactDoc->document_title = $request->input('document_title');
            $contactDoc->document_type  = $request->input('document_type');
            $contactDoc->description    = $request->input('description');
            $contactDoc->save();

            Session::flash('message', 'You have successfully uploaded new document');
            Session::flash('alert_class', 'alert-success');
        }else{
            Session::flash('message', 'Unable to upload document');
            Session::flash('alert_class', 'alert-danger');              
        }
        return redirect()->back();	  
    }
}
