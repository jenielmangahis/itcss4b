<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\ContactDatasource;
use App\Contact;
use App\Stage;
use App\Workflow;
use App\CompanyUser;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactDatasourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'contact_datasource';
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
        $stages              = Stage::all();
        $datasource_import   = ContactDatasource::where('type','=', 1)->get();
        $datasource_webform  = ContactDatasource::where('type','=', 2)->get();

        return view('contact.datasource.index',[
        	'stages' => $stages,
        	'datasource_import' => $datasource_import,
        	'datasource_webform' => $datasource_webform
        ]); 
    }     

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $this->validate($request, [
                    'source_name'        => 'required',
                 ]);
            } else {
                $this->validate($request, [
                    'source_name'        => 'required',                       
                 ]);                
            }

            $company_id   = 0;
            $user_id      = Auth::user()->id;
            $company_user = CompanyUser::where('user_id','=', $user_id)->first();
            if($company_user) {
                $company_id  = $company_user->company_id;
            }        

            $contact_datasource = new ContactDatasource;

            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $contact_datasource->user_id       = $user_id;
                $contact_datasource->company_id    = $company_id;  
            }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                $contact_datasource->user_id       = $user_id;
                $contact_datasource->company_id    = $company_id;  
            } 

            $contact_datasource->source_name  = $request->input('source_name');
            $contact_datasource->type         = $request->input('type');
            $contact_datasource->stage_id     = $request->input('stage_id');
            $contact_datasource->status       = $request->input('status');
            $contact_datasource->compaign_id  = $request->input('compaign_id');
            $contact_datasource->save();
           
            if($contact_datasource) {
                Session::flash('message', 'You have successfully add datasource');
                Session::flash('alert_class', 'alert-success');
                return redirect('contact_datasource');
            } else {
                Session::flash('message', 'Unable to add new datasource');
                Session::flash('alert_class', 'alert-danger');
                return redirect('contact_datasource');
            }

        }else{
            Session::flash('message', 'Unable to add new contact');
            Session::flash('alert_class', 'alert-danger');           
            return redirect()->back();
        }
    }  

    public function edit($id)
    { 
		$id = Hashids::decode($id)[0];

        $stages              = Stage::all();
        $datasource_import   = ContactDatasource::where('type','=', 1)->get();
        $datasource_webform  = ContactDatasource::where('type','=', 2)->get();		
        $datasource          = ContactDatasource::find($id);

        return view('contact.datasource.edit',[
        	'stages' => $stages,
        	'datasource_import' => $datasource_import,
        	'datasource_webform' => $datasource_webform,
        	'datasource' => $datasource
        ]);         
    }

    public function update(Request $request)
    {
        if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
            $this->validate($request, [
                'source_name'        => 'required',
             ]);
        } else {
            $this->validate($request, [
                'source_name'        => 'required',                       
             ]);                
        }

        $company_id   = 0;
        $user_id      = Auth::user()->id;
        $company_user = CompanyUser::where('user_id','=', $user_id)->first();
        if($company_user) {
            $company_id  = $company_user->company_id;
        }        
      
	    $id      = Hashids::decode($request->input('id'))[0];
	    $contact_datasource = ContactDatasource::find($id); 

	    if($contact_datasource) {

            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $contact_datasource->user_id       = $user_id;
                $contact_datasource->company_id    = $company_id;  
            }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                $contact_datasource->user_id       = $user_id;
                $contact_datasource->company_id    = $company_id;  
            } 

            $contact_datasource->source_name  = $request->input('source_name');
            $contact_datasource->type         = $request->input('type');
            $contact_datasource->stage_id     = $request->input('stage_id');
            $contact_datasource->status       = $request->input('status');
            $contact_datasource->compaign_id  = $request->input('compaign_id');
            $contact_datasource->save();	    
            
            if($contact_datasource) {
                Session::flash('message', 'You have successfully update datasource');
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();
            } else {
                Session::flash('message', 'Unable to update datasource');
                Session::flash('alert_class', 'alert-danger');
                return redirect()->back();
            }            	
	    }
    }    

    public function ajax_load_stage_status(Request $request)
    {
        $workflow = Workflow::where('stage_id', '=', $request->input('stage_id'))->get();
        return view('contact.datasource.ajax_load_stage_status_dropdown',[
            'workflow' => $workflow,
            'status' => $request->input('status')
        ]);
    }     

}
