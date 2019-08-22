<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\ContactDatasource;
use App\Contact;
use App\ContactBusinessInformation;
use App\ContactLoanInformation;
use App\ContactBrokerInformation;
use App\Stage;
use App\Workflow;
use App\CompanyUser;
use App\ContactCampaign;
use App\ContactTask;

use UserHelper;
use GlobalHelper;
use Rap2hpoutre\FastExcel\FastExcel;

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

            $pending_task_count = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->count();
            $pending_task       = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->get();

            View::share ( 'pending_task_count', $pending_task_count );   
            View::share ( 'pending_task', $pending_task);                 

            return $next($request);     
        });                 
    }

    public function index(Request $request)
    {
        $stages              = Stage::all();
        $datasource_import   = ContactDatasource::where('type','=', 1)->get();
        $datasource_webform  = ContactDatasource::where('type','=', 2)->get();
        $campaign            = ContactCampaign::where('status','=', 1)->get();

        return view('contact.datasource.index',[
        	'stages' => $stages,
        	'datasource_import' => $datasource_import,
        	'datasource_webform' => $datasource_webform,
        	'campaign' => $campaign
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
        $campaign            = ContactCampaign::where('status','=', 1)->get();

        return view('contact.datasource.edit',[
        	'stages' => $stages,
        	'datasource_import' => $datasource_import,
        	'datasource_webform' => $datasource_webform,
        	'datasource' => $datasource,
        	'campaign' => $campaign
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


        if($request->file()) {

            $path = $request->file('import_file')->getRealPath();
            if($path) {
                $import_contacts = (new FastExcel)->import($path, function ($line) {

                    $post_value   = $_POST;
                    $company_id   = 0;
                    $user_id      = Auth::user()->id;
                    $company_user = CompanyUser::where('user_id','=', $user_id)->first();
                    if($company_user) {
                        $company_id  = $company_user->company_id;
                    }      

                    $workflow = Workflow::where('stage_id','=', $post_value['stage_id'])
                                    ->where('status','=', $post_value['status'])
                                    ->first();   

                    $contact = new Contact;

                    $contact->user_id       = $user_id;
                    $contact->company_id    = $company_id;                     
                    $contact->stage_id      = $post_value['stage_id'];
                    $contact->full_name     = ucfirst($line['firstname']) . ' ' . ucfirst($line['lastname']);
                    $contact->firstname     = ucfirst($line['firstname']);
                    $contact->lastname      = ucfirst($line['lastname']);
                    $contact->email         = $line['email'];
                    $contact->mobile_number = $line['mobile_number'];
                    $contact->work_number   = $line['work_number'];
                    $contact->home_number   = $line['home_number'];
                    $contact->address1      = $line['address1'];
                    $contact->address2      = $line['address2'];
                    $contact->city          = $line['city'];
                    $contact->state         = $line['state'];
                    $contact->zip_code      = $line['zip_code'];
                    $contact->data_source   = $post_value['source_name'];
                    $contact->status        = isset($workflow->id) ? $workflow->id : '';
                    $contact->save();

                    if($contact) {
                        $contact_business_info = new ContactBusinessInformation;

                        $contact_business_info->user_id       = $user_id;
                        $contact_business_info->company_id    = $company_id;  
                        $contact_business_info->contact_id          = $contact->id;
                        $contact_business_info->business_name       = '';
                        $contact_business_info->years_in_business   = 0;
                        $contact_business_info->legal_entity_of_business  = '';
                        $contact_business_info->accept_credit_card_from_customer    = 'NA';
                        $contact_business_info->gross_monthly_credit_card_sales     = 0;
                        $contact_business_info->gross_yearly_sales  = 0;
                        $contact_business_info->filed_bankruptcy    = '';
                        $contact_business_info->credit_score        = 'NA';
                        $contact_business_info->save(); 

                        $contact_loan_info = new ContactLoanInformation;
                        $contact_loan_info->user_id       = $user_id;
                        $contact_loan_info->company_id    = $company_id;  
                        $contact_loan_info->contact_id    = $contact->id;
                        $contact_loan_info->loan_amount   = 0;
                        $contact_loan_info->save();

                        $contact_broker_info = new ContactBrokerInformation;
                        $contact_broker_info->user_id       = $user_id;
                        $contact_broker_info->company_id    = $company_id;         
                        $contact_broker_info->contact_id    = $contact->id;  
                        $contact_broker_info->brokerage_fee = 0;
                        $contact_broker_info->save(); 
                    }

                });  
            }

            Session::flash('message', 'You have successfully import contacts from data source');
            Session::flash('alert_class', 'alert-success');
            return redirect('contact');             


        } else {
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
