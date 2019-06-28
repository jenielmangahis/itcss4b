<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\EmailTemplate;
use App\User;
use App\Companies;

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
            $email_templates = EmailTemplate::paginate(15);
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
            $this->validate($request, [
                'name'           => 'required',
                'user_id'        => 'required',
                'company_id'     => 'required'    
             ]);
            $emailTemplate                 = new EmailTemplate;
            $emailTemplate->company_id     = $request->input('company_id');
            $emailTemplate->user_id        = $request->input('user_id');
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
            $this->validate($request, [
                'name'           => 'required',
                'user_id'        => 'required',
                'company_id'     => 'required'       
             ]);

            $id = Hashids::decode($request->input('id'))[0];
            $emailTemplate = EmailTemplate::find($id);
            if($emailTemplate) {
                $emailTemplate->company_id     = $request->input('company_id');
                $emailTemplate->user_id        = $request->input('user_id');
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
}