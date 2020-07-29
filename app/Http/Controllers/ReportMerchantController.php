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

use App\Companies;

use UserHelper;
use GlobalHelper;

use DB;

use View;
use Hash;
use Hashids;

use Session;

class ReportMerchantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'merchant_logs';
            $with_permission = UserHelper::checkUserRole($group_id, $module); 
            if(!$with_permission) {
                Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                Session::flash('alert_class', 'alert-danger');                
                return redirect('dashboard');
            }    

            $pending_task_count = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->count();
            $pending_task       = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->get();

            $bankruptcy         = UserHelper::getCompaniesBankrupt();

            $idl_contacts = UserHelper::getIdleContacts();
            $idle_contacts_count = 0;
            $idle_contacts       = array();
            if(!empty($idl_contacts)) {
                $idle_contacts_count = $idl_contacts['total_idle'];
                $idle_contacts       = $idl_contacts['idle_data'];
            }
            $settled            = UserHelper::getContactsSettled();
            View::share ( 'settled', $settled );
            View::share ( 'idle_contacts_count', $idle_contacts_count );   
            View::share ( 'idle_contacts', $idle_contacts);             

            View::share ( 'pending_task_count', $pending_task_count );   
            View::share ( 'pending_task', $pending_task);     

            View::share ( 'bankruptcy', $bankruptcy );            

            return $next($request);     
        });                 
    }

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            $merchant_query = Companies::query();

            if($search_by != '' && $search_field != '') {
                $merchant_query = $merchant_query->select(
                            'companies.id','companies.name','companies.contact_number','contacts.firstname','contacts.lastname',
                            'contacts.email','contacts.mobile_number','contacts.work_number'
                        );
                $merchant_query = $merchant_query->leftJoin('contacts', 'contacts.company_id', '=', 'companies.id');
                $merchant_query = $merchant_query->where('companies.'.$search_by, 'like', '%' . $search_field . '%');
                $merchant_query = $merchant_query->where('companies.is_active','=',1);

                $merchants_log = $merchant_query->groupBy('contacts.company_id')->orderBy('contacts.company_id', 'desc')->paginate(25);
            }            
        } else {
            $merchant_query = Companies::query();
            $merchant_query = $merchant_query->select(
                        'companies.id','companies.name','companies.contact_number','contacts.firstname','contacts.lastname',
                        'contacts.email','contacts.mobile_number','contacts.work_number'
                    );
            $merchant_query = $merchant_query->leftJoin('contacts', 'contacts.company_id', '=', 'companies.id');
            $merchant_query = $merchant_query->where('companies.is_active','=',1);

            $merchants_log = $merchant_query->groupBy('contacts.company_id')->orderBy('contacts.company_id', 'desc')->paginate(25);
            //$merchants_log = $merchant_query->groupBy('contacts.company_id')->paginate(25);
            //$merchants_log = $merchant_query->paginate(25);
        }

        return view('reports.merchants_log.index',[
            'merchants_log'    => $merchants_log,
            'search_by'    => $search_by,
            'search_field' => $search_field
        ]); 
    }    

    public function export_merchants(Request $request)
    {
        $search_by    = $request->input('_search_by');
        $search_field = $request->input('_search_field');  

        if($search_by != '' && $search_field != '') {
            $merchant_query = Companies::query();

            if($search_by != '' && $search_field != '') {
                $merchant_query = $merchant_query->select(
                            'companies.id','companies.name','companies.contact_number','contacts.firstname','contacts.lastname',
                            'contacts.email','contacts.mobile_number','contacts.work_number'
                        );
                $merchant_query = $merchant_query->leftJoin('contacts', 'contacts.company_id', '=', 'companies.id');
                $merchant_query = $merchant_query->where('companies.'.$search_by, 'like', '%' . $search_field . '%');
                $merchant_query = $merchant_query->where('companies.is_active','=',1);

                $merchants_log = $merchant_query->groupBy('contacts.company_id')->orderBy('contacts.company_id', 'desc')->get();

            }            
        } else {
            $merchant_query = Companies::query();
            $merchant_query = $merchant_query->select(
                        'companies.id','companies.name','companies.contact_number','contacts.firstname','contacts.lastname',
                        'contacts.email','contacts.mobile_number','contacts.work_number'
                    );
            $merchant_query = $merchant_query->leftJoin('contacts', 'contacts.company_id', '=', 'companies.id');
            $merchant_query = $merchant_query->where('companies.is_active','=',1);

            $merchants_log = $merchant_query->groupBy('contacts.company_id')->orderBy('contacts.company_id', 'desc')->get();            
        }

        return view('reports.merchants_log.export_merchants_log',[
            'merchants_log'    => $merchants_log
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

        return view('reports.merchants_log.audit_logs',[
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

        return view('reports.merchants_log.export_audit_logs',[
            'audit_logs'    => $audit_logs
        ]);         
    }     
}
