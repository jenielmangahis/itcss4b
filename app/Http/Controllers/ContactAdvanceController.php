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
use App\ContactAdvanceUnderwriterNote;
use App\ContactAdvanceFundingInfo;
use App\ContactAdvancePayment;
use App\CompanyUser;
use App\Companies;
use App\Stage;
use App\User;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;
use Carbon;

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
        $count_payment_made  = 0;
        $last_payment_amount = 0;
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

                $total_advance_payment = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->sum('amount');
                $count_payment_made    = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->count();
                $last_payment          = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->orderBy('created_at', 'desc')->first();

                if($last_payment) {
                    $last_payment_amount = $last_payment->amount;              
                }

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
                    'total_advance_payment' => $total_advance_payment,
                    'count_payment_made' => $count_payment_made,
                    'last_payment_amount' => $last_payment_amount,
                ]);                
            }                                   
        /*
         * Contact Advance - End
        */            
    }    

    public function advance_documents($id, Request $request)
    {  
        $count_payment_made  = 0;
        $last_payment_amount = 0;

        $hash_id               = $id;     
        $id                    = Hashids::decode($id)[0]; 
        $contact_advance_query = ContactAdvance::query();

        if($id) {
            $contact_advance = $contact_advance_query->where('id','=', $id)->first();
            $contact         = Contact::where('id', '=', $contact_advance->contact_id)->first();
            $company_user    = CompanyUser::where('company_id','=',$contact->company_id)->get();

            $total_advance_payment = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->sum('amount');
            $count_payment_made    = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->count();
            $last_payment          = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->orderBy('created_at', 'desc')->first();

            if($last_payment) {
                $last_payment_amount = $last_payment->amount;              
            }            

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
                'total_advance_payment' => $total_advance_payment,
                'count_payment_made' => $count_payment_made,
                'last_payment_amount' => $last_payment_amount,                
            ]);                
        }    
    }  

    public function advance_underwriter_notes($id, Request $request)
    {
        $count_payment_made  = 0;
        $last_payment_amount = 0;

        $hash_id               = $id;     
        $id                    = Hashids::decode($id)[0]; 
        $contact_advance_query = ContactAdvance::query();

        if($id) {
            $contact_advance = $contact_advance_query->where('id','=', $id)->first();
            $contact         = Contact::where('id', '=', $contact_advance->contact_id)->first();
            $company_user    = CompanyUser::where('company_id','=',$contact->company_id)->get();   

            $under_writer_note = ContactAdvanceUnderwriterNote::where('contact_advance_id','=', $contact_advance->id)->first();   

            $total_advance_payment = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->sum('amount');
            $count_payment_made    = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->count();
            $last_payment          = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->orderBy('created_at', 'desc')->first();

            if($last_payment) {
                $last_payment_amount = $last_payment->amount;              
            }                  
            
            return view('advances.underwriter-notes', [
                'hash_id' => $hash_id,
                'advance_id' => $id,
                'advance' => $contact_advance,
                'contact' => $contact,
                'company_user' => $company_user,
                'under_writer_note' => $under_writer_note,
                'total_advance_payment' => $total_advance_payment,
                'count_payment_made' => $count_payment_made,
                'last_payment_amount' => $last_payment_amount,                 

            ]);                
        }   
    }  

    public function advance_funding_info($id, Request $request)
    {
        $count_payment_made  = 0;
        $last_payment_amount = 0;

        $hash_id               = $id;     
        $id                    = Hashids::decode($id)[0]; 
        $contact_advance_query = ContactAdvance::query();

        if($id) {
            $contact_advance = $contact_advance_query->where('id','=', $id)->first();
            $contact         = Contact::where('id', '=', $contact_advance->contact_id)->first();
            $company_user    = CompanyUser::where('company_id','=',$contact->company_id)->get();      

            $funding_info = ContactAdvanceFundingInfo::where('contact_advance_id','=', $contact_advance->id)->first(); 

            $total_advance_payment = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->sum('amount');
            $count_payment_made    = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->count();
            $last_payment          = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->orderBy('created_at', 'desc')->first();

            if($last_payment) {
                $last_payment_amount = $last_payment->amount;              
            }             
            
            return view('advances.funding_info', [
                'hash_id' => $hash_id,
                'advance_id' => $id,
                'advance' => $contact_advance,
                'contact' => $contact,
                'company_user' => $company_user,
                'funding_info' => $funding_info,
                'total_advance_payment' => $total_advance_payment,
                'count_payment_made' => $count_payment_made,
                'last_payment_amount' => $last_payment_amount, 
            ]);                
        } 
    }

    public function advance_payments($id, Request $request)
    {
        $count_payment_made  = 0;
        $last_payment_amount = 0;

        $hash_id               = $id;     
        $id                    = Hashids::decode($id)[0]; 
        $contact_advance_query = ContactAdvance::query();

        if($id) {
            $contact_advance = $contact_advance_query->where('id','=', $id)->first();
            $contact         = Contact::where('id', '=', $contact_advance->contact_id)->first();
            $company_user    = CompanyUser::where('company_id','=',$contact->company_id)->get();  

            $users           = User::select('id','firstname','lastname')->where('is_active','=',0)->get();

            $search_field_adv_payment = "";

            $search_by_adv_payment    = $request->input('search_by_adv_payment');
            $search_field_adv_payment = $request->input('search_field_adv_payment');  
            if($search_by_adv_payment != '' && $search_field_adv_payment != '') {
                $advance_payments_query = ContactAdvancePayment::query();

                if($search_by_adv_payment != '' && $search_field_adv_payment != '') {
                    $advance_payments_query = $advance_payments_query->where('contact_advance_payments.'.$search_by_adv_payment, 'like', '%' . $search_field_adv_payment . '%');
                    $advance_payments_query = $advance_payments_query->where('contact_advance_id','=',$contact_advance->id);
                    $advance_payments = $advance_payments_query->paginate(10);
                }            
            } else {
                $advance_payments = ContactAdvancePayment::where('contact_advance_id','=',$contact_advance->id)->paginate(10);
            }

            $total_advance_payment = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->sum('amount');
            $count_payment_made    = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->count();
            $last_payment          = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->orderBy('created_at', 'desc')->first();

            if($last_payment) {
                $last_payment_amount = $last_payment->amount;              
            }             
            
            return view('advances.payments', [
                'hash_id' => $hash_id,
                'advance_id' => $id,
                'advance' => $contact_advance,
                'contact' => $contact,
                'company_user' => $company_user,
                'advance_payments' => $advance_payments,
                'users' => $users,
                'search_field_adv_payment' => $search_field_adv_payment,
                'total_advance_payment' => $total_advance_payment,
                'count_payment_made' => $count_payment_made,
                'last_payment_amount' => $last_payment_amount,                 
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

    public function store_advance(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'transaction_id' => 'required',
                'amount'         => 'required|numeric'
             ]);  

            $_time = Carbon\Carbon::now();
            $process_date = $_time->toDateString();  

            $processed = Auth::user()->firstname . " " . Auth::user()->lastname;

            $id = Hashids::decode($request->input('advance_id'))[0];
            $advance_id = $id;            
            
            $contact_adv_payment = new ContactAdvancePayment;
            $contact_adv_payment->contact_advance_id = $advance_id;
            $contact_adv_payment->transaction_id     = $request->input('transaction_id');
            $contact_adv_payment->amount             = $request->input('amount');
            $contact_adv_payment->type               = $request->input('type');
            $contact_adv_payment->payee_id           = $request->input('payee');
            $contact_adv_payment->memo               = $request->input('memo');
            $contact_adv_payment->processed          = $processed;
            $contact_adv_payment->process_date       = $process_date;
            $contact_adv_payment->status             = $request->input('status');

            //$contact_adv_payment->payee = $request->input('');
            //$contact_adv_payment->cleared_date       = $request->input('');

            $contact_adv_payment->save();

            Session::flash('message', 'You have successfully add payment');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();
        } else {
            Session::flash('message', 'Unable to add payment');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();  
        }     

    }

    public function update_advance_payment(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'transaction_id' => 'required',
                'amount'         => 'required|numeric'
             ]);  

            $payment_id_inc = Hashids::decode($request->input('payment_id'))[0];
            $payment_id     = $payment_id_inc;  

            $ca_payment = ContactAdvancePayment::find($payment_id);
            if($ca_payment) {
                $_time = Carbon\Carbon::now();
                $process_date = $_time->toDateString();  

                $processed = Auth::user()->firstname . " " . Auth::user()->lastname;

                $id = Hashids::decode($request->input('advance_id'))[0];
                $advance_id = $id;            
                
                //$contact_adv_payment->contact_advance_id = $advance_id;
                $ca_payment->transaction_id     = $request->input('transaction_id');
                $ca_payment->amount             = $request->input('amount');
                $ca_payment->type               = $request->input('type');
                $ca_payment->payee_id           = $request->input('payee');
                $ca_payment->memo               = $request->input('memo');
                //$ca_payment->processed          = $processed;
                //$ca_payment->process_date       = $process_date;
                $ca_payment->status             = $request->input('status');

                //$contact_adv_payment->payee = $request->input('');
                //$contact_adv_payment->cleared_date       = $request->input('');

                $ca_payment->save();

                Session::flash('message', 'You have successfully add payment');
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();
            } else {
                Session::flash('message', 'Unable to update payment');
                Session::flash('alert_class', 'alert-danger');  
                return redirect()->back();  
            }

        } else {
            Session::flash('message', 'Unable to update payment');
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

    public function update_underwriter_notes(Request $request) 
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

                // Contact Advance Underwriter Notes - Start
                $contact_au_notes = ContactAdvanceUnderwriterNote::where('contact_advance_id','=', $contact_advance->id)->first();
                if($contact_au_notes) {
                    $contact_au_notes->under_writer_opinion = $request->input('under_writer_opinion');
                    $contact_au_notes->tax_liens_judgements = $request->input('tax_liens_judgements');
                    $contact_au_notes->ucc_position         = $request->input('ucc_position');
                    $contact_au_notes->advance_history_comments = $request->input('advance_history_comments');
                    $contact_au_notes->major_issues         = $request->input('major_issues');
                    $contact_au_notes->required_paperworks_information = $request->input('required_paperworks_information');
                    $contact_au_notes->save();
                } else {
                    $contact_au_notes                       = new ContactAdvanceUnderwriterNote();
                    $contact_au_notes->contact_advance_id   = $contact_advance->id;
                    $contact_au_notes->under_writer_opinion = $request->input('under_writer_opinion');
                    $contact_au_notes->tax_liens_judgements = $request->input('tax_liens_judgements');
                    $contact_au_notes->ucc_position         = $request->input('ucc_position');
                    $contact_au_notes->advance_history_comments = $request->input('advance_history_comments');
                    $contact_au_notes->major_issues         = $request->input('major_issues');
                    $contact_au_notes->required_paperworks_information = $request->input('required_paperworks_information');
                    $contact_au_notes->save();
                }                
                // Contact Advance Underwriter Notes - End

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

    public function update_funding_info(Request $request) 
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

                // Contact Advance Funding Info - Start    
                
                $contact_adv_funding_info = ContactAdvanceFundingInfo::where('contact_advance_id','=', $contact_advance->id)->first();
                if($contact_adv_funding_info) {
                    $contact_adv_funding_info->contract_date    = $request->input('contract_date');
                    $contact_adv_funding_info->contract_number  = $request->input('contract_number');
                    $contact_adv_funding_info->funding_date     = $request->input('funding_date');
                    $contact_adv_funding_info->wire_conf_number = $request->input('wire_conf_number');
                    $contact_adv_funding_info->routing_number   = $request->input('routing_number');
                    $contact_adv_funding_info->account_number   = $request->input('account_number');
                    $contact_adv_funding_info->account_type     = $request->input('account_type');
                    $contact_adv_funding_info->name_of_account  = $request->input('name_of_account');
                    $contact_adv_funding_info->ach_gateway      = $request->input('ach_gateway');
                    $contact_adv_funding_info->save();
                } else {
                    $contact_adv_funding_info                     = new ContactAdvanceFundingInfo();
                    $contact_adv_funding_info->contact_advance_id = $contact_advance->id;
                    $contact_adv_funding_info->contract_date    = $request->input('contract_date');
                    $contact_adv_funding_info->contract_number  = $request->input('contract_number');
                    $contact_adv_funding_info->funding_date     = $request->input('funding_date');
                    $contact_adv_funding_info->wire_conf_number = $request->input('wire_conf_number');
                    $contact_adv_funding_info->routing_number   = $request->input('routing_number');
                    $contact_adv_funding_info->account_number   = $request->input('account_number');
                    $contact_adv_funding_info->account_type     = $request->input('account_type');
                    $contact_adv_funding_info->name_of_account  = $request->input('name_of_account');
                    $contact_adv_funding_info->ach_gateway      = $request->input('ach_gateway');
                    $contact_adv_funding_info->save();
                }                  
                // Contact Advance Funding Info - End

                Session::flash('message', 'You have successfully update advances and funding info');
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();                 
            } else {
                Session::flash('message', 'Unable to update advances and funding info');
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
  
    public function destroy_payment(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $ca = ContactAdvancePayment::find($id);

            if($ca) {   
                $ca->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();
            }
        }
    }    

    public function ajax_load_stage_status(Request $request)
    {
        $workflow = Workflow::where('stage_id', '=', $request->input('stage_id'))->get();
        $status = $request->input('status');
        return view('workflow.ajax_load_stage_status_dropdown',[
            'workflow' => $workflow,
            'status' => $status
        ]);
    }     

}
