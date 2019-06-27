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
}
