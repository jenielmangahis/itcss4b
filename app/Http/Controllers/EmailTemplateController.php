<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\EmailTemplate;
use App\User;
use App\Companies;
use App\CompanyUser;
use App\ContactTask;
use App\ContactHistory;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class EmailTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');       
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'email_templates';
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
            $email_template_query = EmailTemplate::query();
            $email_template_query->join('users', 'users.id', '=', 'email_templates.user_id');

            if($search_by != '' && $search_field != '') {
                $email_template_query = $email_template_query->where('email_templates.'.$search_by, 'like', '%' . $search_field . '%');
                $email_templates = $email_template_query->paginate(15);
            }            
        } else {
            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $user_id = Auth::user()->id;    
                $email_templates = EmailTemplate::where('user_id','=', $user_id)
                            ->paginate(15); 
            }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                $email_templates = EmailTemplate::paginate(15);  
            }
        }
        return view('email_template.index',[
        	'email_templates' => $email_templates,
            'search_field' => $search_field
        ]); 
    }

    public function create()
    {
    	$emailTemplate = EmailTemplate::get();
    	$companies = Companies::all();

        return view('email_template.create', [
            'emailTemplate' => $emailTemplate,
            'companies' => $companies
        ]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            
            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $this->validate($request, [
                    'name'           => 'required', 
                ]);

                $user_id = Auth::user()->id;    
                $company_user = CompanyUser::where('user_id','=', $user_id)->first();                
                if($company_user) {
                    $company_id  = $company_user->company_id;
                }
            }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                $this->validate($request, [
                    'name'           => 'required',
                    'user_id'        => 'required',
                    'company_id'     => 'required'    
                ]);

                $company_id = $request->input('company_id');
                $user_id = $request->input('user_id');
            }
            $emailTemplate                 = new EmailTemplate;
            $emailTemplate->company_id     = $company_id;
            $emailTemplate->user_id        = $user_id;
            $emailTemplate->name           = $request->input('name');
            $emailTemplate->content        = $request->input('content');
            $emailTemplate->save();

            Session::flash('message', 'You have successfully created new email template');
            Session::flash('alert_class', 'alert-success');
            return redirect('email_template');

        }else{
            Session::flash('message', 'Unable to create new email template');
            Session::flash('alert_class', 'alert-danger');  
            return redirect('email_template');
        }
    }

    public function edit($id)
    {     
        $id = Hashids::decode($id)[0];
        $emailTemplate   = EmailTemplate::where('id', '=', $id)->first();
        $companies = Companies::all();

        return view('email_template.edit', [
            'emailTemplate' => $emailTemplate,
            'companies' => $companies
        ]);
    }

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $this->validate($request, [
                    'name'           => 'required', 
                ]);

                $user_id = Auth::user()->id;    
                $company_user = CompanyUser::where('user_id','=', $user_id)->first();                
                if($company_user) {
                    $company_id  = $company_user->company_id;
                }
            }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                $this->validate($request, [
                    'name'           => 'required',
                    'user_id'        => 'required',
                    'company_id'     => 'required'    
                ]);

                $company_id = $request->input('company_id');
                $user_id = $request->input('user_id');
            }

            $id = Hashids::decode($request->input('id'))[0];
            $emailTemplate = EmailTemplate::find($id);
            if($emailTemplate) {
                $emailTemplate->company_id     = $company_id;
                $emailTemplate->user_id        = $user_id;
                $emailTemplate->name           = $request->input('name');
                $emailTemplate->content        = $request->input('content');
                $emailTemplate->save();

                Session::flash('message', 'Email Template has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('email_template');
            }
        }

        Session::flash('message', 'Unable to update Email Template');
        Session::flash('alert_class', 'alert-danger');
        return redirect('email_template');
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $emailTemplate = EmailTemplate::find($id);

            if($emailTemplate) {   
                $emailTemplate->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('email_template');
            }
        }
    }

    public function ajax_load_email_template_content(Request $request)
    {
        $emailTemplate = EmailTemplate::where('id', '=', $request->input('email_template_id'))->first();
        return view('email_template.ajax_load_email_template_content',[
            'emailTemplate' => $emailTemplate
        ]);
    }
}
