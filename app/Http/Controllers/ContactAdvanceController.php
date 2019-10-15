<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\ContactAdvance;
use App\ContactTask;
use App\Contact;
use App\ContactDocs;
use App\ContactBusinessInformation;
use App\ContactBrokerInformation;
use App\ContactLoanInformation;
use App\CompanyUser;
use App\Companies;
use App\Stage;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactAdvanceController extends Controller
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

            View::share ( 'pending_task_count', $pending_task_count );   
            View::share ( 'pending_task', $pending_task);                  

            return $next($request);     
        });                 
    }
    
    public function advance_application($id)
    {  
        /*
         * Contact Advance - Start
        */    
            $hash_id               = $id;     
            $id                    = Hashids::decode($id)[0]; 
            $contact_advance_query = ContactAdvance::query();
            if($id) {
                $contact_advance = $contact_advance_query->where('id','=', $id)->first();

                $stages    = Stage::all();
                $companies = Companies::all();      
                
                $contact = Contact::where('id', '=', $contact_advance->contact_id)->first();
                $contact_business_info = ContactBusinessInformation::where('contact_id', '=', $contact_advance->contact_id)->first();
                $contact_loan_info     = ContactLoanInformation::where('contact_id', '=', $contact_advance->contact_id)->first();
                $contact_broker_info   = ContactBrokerInformation::where('contact_id', '=', $contact_advance->contact_id)->first();  

                $company_user = CompanyUser::where('company_id','=',$contact->company_id)->get();

                return view('advances.index', [
                    'hash_id' => $hash_id,
                    'advance_id' => $id,
                    'advance' => $contact_advance,
                    'contact' => $contact,
                    'stages' => $stages,
                    'companies' => $companies,
                    'contact_business_info' => $contact_business_info,
                    'contact_loan_info' => $contact_loan_info,
                    'contact_broker_info' => $contact_broker_info,
                    'company_user' => $company_user,      
                ]);                
            }                                   
        /*
         * Contact Advance - End
        */            
    }    

    public function advance_documents($id, Request $request)
    {  
        $hash_id               = $id;     
        $id                    = Hashids::decode($id)[0]; 
        $contact_advance_query = ContactAdvance::query();

        if($id) {
            $contact_advance = $contact_advance_query->where('id','=', $id)->first();
            $contact         = Contact::where('id', '=', $contact_advance->contact_id)->first();
            $company_user    = CompanyUser::where('company_id','=',$contact->company_id)->get();

            /*
             * For docs - start
            */  
            //$search_by_documents = "";
            $search_field_documents = "";

            $search_by_documents    = $request->input('search_by_documents');
            $search_field_documents = $request->input('search_field_documents');  
            if($search_by_documents != '' && $search_field_documents != '') {
                $contact_docs_query = ContactDocs::query();

                if($search_by_documents != '' && $search_field_documents != '') {
                    $contact_docs_query = $contact_docs_query->where('contact_docs.'.$search_by_documents, 'like', '%' . $search_field_documents . '%');
                    $contact_docs_query = $contact_docs_query->where('contact_id','=', $contact->id);
                    $contactDocs = $contact_docs_query->paginate(10);
                }            
            } else {
                $contactDocs = ContactDocs::where('contact_id', '=', $contact->id)->paginate(10);
            }

            $contactDoc = new ContactDocs();
            $documentTypes = $contactDoc->documentTypes();
            /*
             * Docs - end
            */            
            
            return view('advances.documents', [
                'hash_id' => $hash_id,
                'advance_id' => $id,
                'advance' => $contact_advance,
                'contact' => $contact,
                'company_user' => $company_user,
                'contactDocs' => $contactDocs,
                'search_field_documents ' => $search_field_documents,
                'documentTypes' => $documentTypes,
                'group_id' => Auth::user()->group_id,
            ]);                
        }    
    }    

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'advance_type'        => 'required',
                'payment_method'      => 'required',
                'advance_amount'      => 'required',
                'payment_period_type' => 'required',
                'payment_period'      => 'required|numeric'
             ]);         

            $advance_amount = $request->input('advance_amount');
            $factor_rate    = $request->input('factor_rate');
            $payment_period = $request->input('payment_period');

            $payback_amount = $advance_amount * $factor_rate;
            $payment        = $payback_amount / $payment_period;

            $loan_id         = GlobalHelper::generate_order_number(rand(0,9999));
            $contract_number = GlobalHelper::generate_order_number(rand(0,9999));
            $contact_id      = Hashids::decode($request->input('contact_id'))[0];

            $contact_adv                  = new ContactAdvance;
            $contact_adv->contact_id      = $contact_id;
            $contact_adv->loan_id         = $loan_id;
            $contact_adv->contract_number = $contract_number;
            $contact_adv->amount          = $advance_amount;
            $contact_adv->payback         = $payback_amount;
            $contact_adv->balance         = 0;
            $contact_adv->factor_rate     = $request->input('factor_rate');
            $contact_adv->remit           = $request->input('remit');
            $contact_adv->period          = $request->input('payment_period');
            $contact_adv->period_type     = $request->input('payment_period_type');
            $contact_adv->payment         = $payment;
            $contact_adv->advance_type    = $request->input('advance_type');
            $contact_adv->payment_method  = $request->input('payment_method');
            $contact_adv->status          = "Started"; //Paid in Full, Pricing, Started
            $contact_adv->save();            


            Session::flash('message', 'You have successfully created new advances');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();             
		} else {
            Session::flash('message', 'Unable to create new advances');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();			
		}
    } 

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'advance_type'        => 'required',
                'payment_method'      => 'required',
                'advance_amount'      => 'required',
                'payment_period_type' => 'required',
                'payment_period'      => 'required|numeric'
             ]); 

            $id = Hashids::decode($request->input('advance_id'))[0];
            $advance_id = $id;
            $contact_advance = ContactAdvance::find($advance_id);

            if($contact_advance) {

                $advance_amount = $request->input('advance_amount');
                $factor_rate    = $request->input('factor_rate');
                $payment_period = $request->input('payment_period');

                $payback_amount = $advance_amount * $factor_rate;
                $payment        = $payback_amount / $payment_period;

                $contact_advance->amount          = $advance_amount;
                $contact_advance->payback         = $payback_amount;
                $contact_advance->factor_rate     = $request->input('factor_rate');
                $contact_advance->remit           = $request->input('remit');
                $contact_advance->period          = $request->input('payment_period');
                $contact_advance->period_type     = $request->input('payment_period_type');
                $contact_advance->payment         = $payment;
                $contact_advance->advance_type    = $request->input('advance_type');
                $contact_advance->payment_method  = $request->input('payment_method');
                $contact_advance->save();  

                Session::flash('message', 'You have successfully update advances');
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();                                   
            } else {
                Session::flash('message', 'Unable to update advances');
                Session::flash('alert_class', 'alert-danger');  
                return redirect()->back();                      
            }
        }

    }    

    public function update_application(Request $request)
    {
        if ($request->isMethod('post'))
        {
            /*$this->validate($request, [
                'advance_type'        => 'required',
                'payment_method'      => 'required',
                'advance_amount'      => 'required',
                'payment_period_type' => 'required',
                'payment_period'      => 'required|numeric'
             ]); */

            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $this->validate($request, [
                    'firstname'        => 'required',
                    'lastname'         => 'required',
                    'email'            => 'required|email',
                    'mobile_number'    => 'required',  
                    'address1'         => 'required',   
                    'zip_code'         => 'required',          
                    'gross_monthly_credit_card_sales' => 'numeric',
                    'gross_yearly_sales' => 'numeric', 
                    'loan_amount'        => 'numeric',
                    'brokerage_fee'      => 'numeric',      

                    'advance_type'        => 'required',
                    'payment_method'      => 'required',
                    'advance_amount'      => 'required',
                    'payment_period_type' => 'required',
                    'payment_period'      => 'required|numeric' 
                                                
                 ]);
            } else {
                $this->validate($request, [
                    'firstname'        => 'required',
                    'lastname'         => 'required',
                    'email'            => 'required|email',
                    'mobile_number'    => 'required',  
                    'address1'         => 'required',   
                    'zip_code'         => 'required',  
                    'company_id'       => 'required',
                    'user_id'          => 'required',
                    'gross_monthly_credit_card_sales' => 'numeric',
                    'gross_yearly_sales' => 'numeric', 
                    'loan_amount'        => 'numeric',
                    'brokerage_fee'      => 'numeric',       

                    'advance_type'        => 'required',
                    'payment_method'      => 'required',
                    'advance_amount'      => 'required',
                    'payment_period_type' => 'required',
                    'payment_period'      => 'required|numeric'     
                                          
                 ]);                
            }           

            $id = Hashids::decode($request->input('advance_id'))[0];
            $advance_id = $id;
            $contact_advance = ContactAdvance::find($advance_id);

            if($contact_advance) {
                $advance_amount = $request->input('advance_amount');
                $factor_rate    = $request->input('factor_rate');
                $payment_period = $request->input('payment_period');

                $payback_amount = $advance_amount * $factor_rate;
                $payment        = $payback_amount / $payment_period;

                $contact_advance->lender_id            = $request->input('lender_id');
                $contact_advance->sales_user_id        = $request->input('sales_user_id');
                $contact_advance->under_writer_user_id = $request->input('under_writer_user_id');
                $contact_advance->closer_user_id       = $request->input('closer_user_id');

                $contact_advance->amount          = $advance_amount;
                $contact_advance->payback         = $payback_amount;
                $contact_advance->factor_rate     = $request->input('factor_rate');
                $contact_advance->remit           = $request->input('remit');
                $contact_advance->period          = $request->input('payment_period');
                $contact_advance->period_type     = $request->input('payment_period_type');
                $contact_advance->payment         = $payment;
                $contact_advance->advance_type    = $request->input('advance_type');
                $contact_advance->payment_method  = $request->input('payment_method');
                $contact_advance->save();  


                //Update contact details - start
                $contact_id = $request->input('contact_id');
                $contact    = Contact::find($contact_id); 

                if($contact) {

                    if(UserHelper::isAdminUser(Auth::user()->group_id)) {
                        $contact->user_id       = $request->input('user_id');
                        $contact->company_id    = $request->input('company_id');
                    } 

                    $contact->stage_id      = $request->input('stage_id');
                    $contact->full_name     = ucfirst($request->input('firstname')) . ' ' . ucfirst($request->input('lastname'));
                    $contact->firstname     = ucfirst($request->input('firstname'));
                    $contact->lastname      = ucfirst($request->input('lastname'));
                    $contact->email         = $request->input('email');
                    $contact->mobile_number = $request->input('mobile_number');
                    $contact->work_number   = $request->input('work_number');
                    $contact->home_number   = $request->input('home_number');
                    $contact->address1      = $request->input('address1');
                    $contact->address2      = $request->input('address2');
                    $contact->city          = $request->input('city');
                    $contact->state         = $request->input('state');
                    $contact->zip_code      = $request->input('zip_code');
                    $contact->status        = $request->input('status');
                    $contact->save();

                    if($contact) {
                        $contact_business_info = ContactBusinessInformation::where('contact_id', '=', $contact_id)->first(); 

                        if($contact_business_info) {

                            if(UserHelper::isAdminUser(Auth::user()->group_id)) {
                                $contact_business_info->user_id       = $request->input('user_id');
                                $contact_business_info->company_id    = $request->input('company_id');
                            } 

                            $contact_business_info->contact_id          = $contact->id;
                            $contact_business_info->business_name       = $request->input('business_name');
                            $contact_business_info->years_in_business   = $request->input('years_in_business');
                            $contact_business_info->legal_entity_of_business  = $request->input('legal_entity_of_business');
                            $contact_business_info->accept_credit_card_from_customer    = !empty($request->input('accept_credit_card_from_customer')) ? $request->input('accept_credit_card_from_customer') : 'NA';
                            $contact_business_info->gross_monthly_credit_card_sales     = !empty($request->input('gross_monthly_credit_card_sales')) ? $request->input('gross_monthly_credit_card_sales') : 0;
                            $contact_business_info->gross_yearly_sales  = !empty($request->input('gross_yearly_sales')) ? $request->input('gross_yearly_sales') : 0;
                            $contact_business_info->filed_bankruptcy    = $request->input('filed_bankruptcy');
                            $contact_business_info->bankruptcy_filed    = !empty($request->input('bankruptcy_filed')) ? $request->input('bankruptcy_filed') : '1910-01-01';
                            $contact_business_info->credit_score        = !empty($request->input('credit_score')) ? $request->input('credit_score') : 'NA';
                            $contact_business_info->save(); 
                        }

                        $contact_loan_info = ContactLoanInformation::where('contact_id', '=', $contact_id)->first(); 
                        if($contact_loan_info) {
                            if(UserHelper::isAdminUser(Auth::user()->group_id)) {
                                $contact_loan_info->user_id       = $request->input('user_id');
                                $contact_loan_info->company_id    = $request->input('company_id');
                            }         
                            
                            $contact_loan_info->contact_id    = $contact->id;
                            $contact_loan_info->loan_amount   = !empty($request->input('loan_amount')) ? $request->input('loan_amount') : 0;
                            $contact_loan_info->save();
                        }

                        $contact_broker_info = ContactBrokerInformation::where('contact_id', '=', $contact_id)->first(); 
                        if($contact_broker_info) {
                            if(UserHelper::isAdminUser(Auth::user()->group_id)) {
                                $contact_broker_info->user_id       = $request->input('user_id');
                                $contact_broker_info->company_id    = $request->input('company_id');
                            }         
                            
                            $contact_broker_info->contact_id    = $contact->id;  
                            $contact_broker_info->brokerage_fee = !empty($request->input('brokerage_fee')) ? $request->input('brokerage_fee') : 0;   
                            $contact_broker_info->save(); 
                        }

                    }               
                } 
                //Update contact details - end

                Session::flash('message', 'You have successfully update advances');
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();                 
            } else {
                Session::flash('message', 'Unable to update advances');
                Session::flash('alert_class', 'alert-danger');  
                return redirect()->back();                      
            }       

        }        
    }

    public function update_advance(Request $request) 
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'advance_type'        => 'required',
                'payment_method'      => 'required',
                'advance_amount'      => 'required',
                'payment_period_type' => 'required',
                'payment_period'      => 'required|numeric'
             ]); 

            echo '<pre>';
            print_r($request->input());
            echo '</pre>';

            $id = Hashids::decode($request->input('advance_id'))[0];
            $advance_id = $id;
            $contact_advance = ContactAdvance::find($advance_id);

            if($contact_advance) {

                $advance_amount = $request->input('advance_amount');
                $factor_rate    = $request->input('factor_rate');
                $payment_period = $request->input('payment_period');

                $payback_amount = $advance_amount * $factor_rate;
                $payment        = $payback_amount / $payment_period;

                $contact_advance->lender_id            = $request->input('lender_id');
                $contact_advance->sales_user_id        = $request->input('sales_user_id');
                $contact_advance->under_writer_user_id = $request->input('under_writer_user_id');
                $contact_advance->closer_user_id       = $request->input('closer_user_id');

                $contact_advance->amount          = $advance_amount;
                $contact_advance->payback         = $payback_amount;
                $contact_advance->factor_rate     = $request->input('factor_rate');
                $contact_advance->remit           = $request->input('remit');
                $contact_advance->period          = $request->input('payment_period');
                $contact_advance->period_type     = $request->input('payment_period_type');
                $contact_advance->payment         = $payment;
                $contact_advance->advance_type    = $request->input('advance_type');
                $contact_advance->payment_method  = $request->input('payment_method');
                $contact_advance->save();  

                Session::flash('message', 'You have successfully update advances');
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();                 
            } else {
                Session::flash('message', 'Unable to update advances');
                Session::flash('alert_class', 'alert-danger');  
                return redirect()->back();                      
            }             

        }
    }
    
    public function ajax_load_payback_payment_computation(Request $request)
    {
        $advance_amount = $request->input('advance_amount');
        $factor_rate    = $request->input('factor_rate');
        $payment_period = $request->input('payment_period');

        $payback_amount = 0;
        $payment        = 0;

        if(isset($advance_amount) && isset($factor_rate) & isset($payment_period)) {
	        //$payback_amount = $advance_amount * ($factor_rate / 100);
            $payback_amount = $advance_amount * $factor_rate;
	        $payment        = $payback_amount / $payment_period;
        }

        return view('contact.dashboard.ajax.ajax_load_payback_payment_computation',[
        	'payback_amount' => $payback_amount,
        	'payment' => $payment
        ]); 
    }

    public function ajax_load_payback_payment_computation_edit(Request $request)
    {
        $advance_amount = $request->input('advance_amount');
        $factor_rate    = $request->input('factor_rate');
        $payment_period = $request->input('payment_period');

        $payback_amount = 0;
        $payment        = 0;

        if(isset($advance_amount) && isset($factor_rate) & isset($payment_period)) {
            //$payback_amount = $advance_amount * ($factor_rate / 100);
            $payback_amount = $advance_amount * $factor_rate;
            $payment        = $payback_amount / $payment_period;
        }

        return view('contact.dashboard.ajax.ajax_load_payback_payment_computation',[
            'payback_amount' => $payback_amount,
            'payment' => $payment
        ]); 
    }    

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $ca = ContactAdvance::find($id);

            if($ca) {   
                $ca->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();
            }
        }
    }     

}
