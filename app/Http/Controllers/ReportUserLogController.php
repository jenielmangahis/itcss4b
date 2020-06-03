<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Contact;
use App\ContactTask;
use App\ContactHistory;
use App\User;
use App\UserLog;
use App\ContactBusinessInformation;

use UserHelper;
use GlobalHelper;

use DB;

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

            $bankruptcy_count   = ContactBusinessInformation::where('filed_bankruptcy','=','Yes')->where('bankruptcy_filed','<=',now()->subMonth(2))->count();

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

            View::share ( 'bankruptcy_count', $bankruptcy_count );            

            return $next($request);     
        });                 
    }

    public function indexBackup(Request $request)
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

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            $users_log_query = UserLog::query();

            if($search_by != '' && $search_field != '') {
                if($search_by == 'login_date') {
                    $users_log_query = $users_log_query->select(
                        'users.firstname','users.lastname','user_logs.id','user_logs.login_date','users.email','user_logs.user_id'
                    );

                    $users_log_query = $users_log_query->leftJoin('users', 'users.id', '=', 'user_logs.user_id');
                    $users_log_query = $users_log_query->whereDate('user_logs.'.$search_by, $search_field);
                    $users_log_query = $users_log_query->where('users.is_active','=',0);
                    $users_log = $users_log_query->groupBy(DB::raw("DATE(login_date)"),'users.email')->paginate(25);
                } else {
                    $users_log_query = $users_log_query->select(
                        'users.firstname','users.lastname','user_logs.id','user_logs.login_date','users.email','user_logs.user_id'
                    );
                    $users_log_query = $users_log_query->leftJoin('users', 'users.id', '=', 'user_logs.user_id');
                    $users_log_query = $users_log_query->where('users.'.$search_by, 'like', '%' . $search_field . '%');
                    $users_log_query = $users_log_query->where('users.is_active','=',0);
                    $users_log = $users_log_query->groupBy(DB::raw("DATE(login_date)"),'users.email')->paginate(25);
                }
            }            
        } else {
            $users_log_query = UserLog::query();
            $users_log_query = $users_log_query->select(
                        'user_logs.login_date','users.firstname','users.lastname','user_logs.id','users.email','user_logs.user_id'
                    );
            $users_log_query = $users_log_query->leftJoin('users', 'users.id', '=', 'user_logs.user_id');
            $users_log_query = $users_log_query->where('users.is_active','=',0);
            //$users_log = $users_log_query->groupBy(DB::raw("DATE(login_date)"))->paginate(25);
            $users_log = $users_log_query->groupBy(DB::raw("DATE(login_date)"),'users.email')->paginate(25);
        }

        return view('reports.users_log.user_logs',[
            'users_log'    => $users_log,
            'search_by'    => $search_by,
            'search_field' => $search_field
        ]); 
    }    

    public function export_users_log(Request $request)
    {
        $search_by    = $request->input('_search_by');
        $search_field = $request->input('_search_field');  

        if($search_by != '' && $search_field != '') {
            $users_log_query = UserLog::query();

            if($search_by != '' && $search_field != '') {
                if($search_by == 'login_date') {
                    $users_log_query = $users_log_query->select(
                        'users.firstname','users.lastname','user_logs.id','user_logs.login_date','users.email','user_logs.user_id'
                    );

                    $users_log_query = $users_log_query->leftJoin('users', 'users.id', '=', 'user_logs.user_id');
                    $users_log_query = $users_log_query->whereDate('user_logs.'.$search_by, $search_field);
                    $users_log_query = $users_log_query->where('users.is_active','=',0);
                    $users_log = $users_log_query->groupBy(DB::raw("DATE(login_date)"),'users.email')->paginate(25);
                } else {
                    $users_log_query = $users_log_query->select(
                        'users.firstname','users.lastname','user_logs.id','user_logs.login_date','users.email','user_logs.user_id'
                    );
                    $users_log_query = $users_log_query->leftJoin('users', 'users.id', '=', 'user_logs.user_id');
                    $users_log_query = $users_log_query->where('users.'.$search_by, 'like', '%' . $search_field . '%');
                    $users_log_query = $users_log_query->where('users.is_active','=',0);
                    $users_log = $users_log_query->groupBy(DB::raw("DATE(login_date)"),'users.email')->get();
                }
            }            
        } else {
            $users_log_query = UserLog::query();
            $users_log_query = $users_log_query->select(
                        'users.firstname','users.lastname','user_logs.id','user_logs.login_date','users.email','user_logs.user_id'
                    );
            $users_log_query = $users_log_query->leftJoin('users', 'users.id', '=', 'user_logs.user_id');
            $users_log = $users_log_query->groupBy(DB::raw("DATE(login_date)"),'users.email')->get();
        }

        return view('reports.users_log.export_users_log',[
            'users_log'    => $users_log
        ]);         
    }  

    public function audit_logs(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            $audit_log_query = ContactHistory::query();

            if($search_by != '' && $search_field != '') {
                if($search_by == 'created_at') {
                    $audit_log_query = $audit_log_query->select(
                        'users.firstname','users.lastname','users.email',
                        'contact_history.title','contact_history.module',
                        'contact_history.created_at'
                    );
                    $audit_log_query = $audit_log_query->leftJoin('users', 'users.id', '=', 'contact_history.user_id');
                    $audit_log_query = $audit_log_query->whereDate('contact_history.'.$search_by, $search_field);
                    $audit_logs = $audit_log_query->orderBy('contact_history.created_at', 'desc')->paginate(25);
                } else {
                    $audit_log_query = $audit_log_query->select(
                        'users.firstname','users.lastname','users.email',
                        'contact_history.title','contact_history.module',
                        'contact_history.created_at'
                    );
                    $audit_log_query = $audit_log_query->leftJoin('users', 'users.id', '=', 'contact_history.user_id');
                    $audit_log_query = $audit_log_query->where('users.'.$search_by, 'like', '%' . $search_field . '%');
                    $audit_logs = $audit_log_query->orderBy('contact_history.created_at', 'desc')->paginate(25);
                }
            }            
        } else {
            $audit_log_query = ContactHistory::query();
            $audit_log_query = $audit_log_query->select(
                        'users.firstname','users.lastname','users.email',
                        'contact_history.title','contact_history.module',
                        'contact_history.created_at'
                );
            $audit_log_query = $audit_log_query->leftJoin('users', 'users.id', '=', 'contact_history.user_id');
            $audit_logs = $audit_log_query->orderBy('contact_history.created_at', 'desc')->paginate(25);
        }

        return view('reports.audit_log.audit_logs',[
            'audit_logs'    => $audit_logs,
            'search_by'    => $search_by,
            'search_field' => $search_field
        ]); 
    }

    public function export_audit_logs(Request $request)
    {
        $search_by    = $request->input('_search_by');
        $search_field = $request->input('_search_field');  

        if($search_by != '' && $search_field != '') {
            $audit_log_query = ContactHistory::query();

            if($search_by != '' && $search_field != '') {
                if($search_by == 'created_at') {
                    $audit_log_query = $audit_log_query->select(
                        'users.firstname','users.lastname','users.email',
                        'contact_history.title','contact_history.module',
                        'contact_history.created_at'
                    );
                    $audit_log_query = $audit_log_query->leftJoin('users', 'users.id', '=', 'contact_history.user_id');
                    $audit_log_query = $audit_log_query->whereDate('contact_history.'.$search_by, $search_field);
                    $audit_logs = $audit_log_query->orderBy('contact_history.created_at', 'desc')->get();
                } else {
                    $audit_log_query = $audit_log_query->select(
                        'users.firstname','users.lastname','users.email',
                        'contact_history.title','contact_history.module',
                        'contact_history.created_at'
                    );
                    $audit_log_query = $audit_log_query->leftJoin('users', 'users.id', '=', 'contact_history.user_id');
                    $audit_log_query = $audit_log_query->where('users.'.$search_by, 'like', '%' . $search_field . '%');
                    $audit_logs = $audit_log_query->orderBy('contact_history.created_at', 'desc')->get();
                }
            }            
        } else {
            $audit_log_query = ContactHistory::query();
            $audit_log_query = $audit_log_query->select(
                        'users.firstname','users.lastname','users.email',
                        'contact_history.title','contact_history.module',
                        'contact_history.created_at'
                );
            $audit_log_query = $audit_log_query->leftJoin('users', 'users.id', '=', 'contact_history.user_id');
            $audit_logs = $audit_log_query->orderBy('contact_history.created_at', 'desc')->paginate(25);
        }

        return view('reports.audit_log.export_audit_logs',[
            'audit_logs'    => $audit_logs
        ]);         
    }     
}
