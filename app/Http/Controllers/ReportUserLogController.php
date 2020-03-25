<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Contact;
use App\ContactTask;
use App\User;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ReportUserLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'users_log';
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

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            $users_log_query = User::query();

            if($search_by != '' && $search_field != '') {
                $users_log_query = $users_log_query->where('users.'.$search_by, 'like', '%' . $search_field . '%');
                $users_log_query = $users_log_query->where('users.is_active','=',0);
                $users_log = $users_log_query->paginate(10);
            }            
        } else {
            $users_log = User::where('is_active','=',0)->paginate(10);
        }

        return view('reports.users_log.index',[
        	'users_log' => $users_log,
            'search_field' => $search_field
        ]); 
    }    
}
