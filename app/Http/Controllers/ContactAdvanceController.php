<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
use App\ContactAdvanceMerchantStatementRecord;
use App\ContactAdvanceFinancialBankStatementRecord;
use App\ContactAdvanceSubmission;
use App\ContactAdvanceParticipation;
use App\ContactHistory;
use App\CompanyUser;
use App\EmailTemplate;
use App\Lender;
use App\Companies;
use App\Stage;
use App\User;

use UserHelper;
use GlobalHelper;

use App\Mail\MailContact;
use App\Mail\MailSubmission;

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

                $lenders = Lender::all();

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
                    'lenders' => $lenders,
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

            $lenders = Lender::all();        
            
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
                'lenders' => $lenders,        
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

            $lenders = Lender::all();        
            
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
                'lenders' => $lenders,              

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
            
            $lenders = Lender::all();

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
                'lenders' => $lenders,
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

            $lenders = Lender::all();         
            
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
                'lenders' => $lenders,                
            ]);                
        } 
    }
    
    public function advance_financials($id, Request $request)
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

            $total_advance_payment = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->sum('amount');
            $count_payment_made    = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->count();
            $last_payment          = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->orderBy('created_at', 'desc')->first();

            if($last_payment) {
                $last_payment_amount = $last_payment->amount;              
            }     

            $contact_adv_financial_bank_statement = ContactAdvanceFinancialBankStatementRecord::where('contact_advance_id','=', $contact_advance->id)->get();  
            
            $contact_adv_financial_bank_statement_array = array();
            if(!$contact_adv_financial_bank_statement->isEmpty()) {
                $contact_adv_financial_bank_statement_array = $contact_adv_financial_bank_statement->toArray();
            }

            $contact_adv_merchant_statement = ContactAdvanceMerchantStatementRecord::where('contact_advance_id','=', $contact_advance->id)->get();  
            
            $contact_adv_merchant_statement_array = array();
            if(!$contact_adv_merchant_statement->isEmpty()) {
                $contact_adv_merchant_statement_array = $contact_adv_merchant_statement->toArray();
            }

            $lenders = Lender::all(); 

            $year_arr   = array();
            $start_year = date('Y') - 1;
            $end_year   = date('Y') + 5;
            for ($start_year; $start_year <= $end_year; $start_year++) {
                $year_arr[] = $start_year;
            }

            return view('advances.financials', [
                'hash_id' => $hash_id,
                'advance_id' => $id,
                'advance' => $contact_advance,
                'contact' => $contact,
                'company_user' => $company_user,
                'users' => $users,
                'total_advance_payment' => $total_advance_payment,
                'count_payment_made' => $count_payment_made,
                'last_payment_amount' => $last_payment_amount,
                'contact_adv_financial_bank_statement' => $contact_adv_financial_bank_statement_array,
                'contact_adv_merchant_statement' => $contact_adv_merchant_statement_array,
                'lenders' => $lenders,
                'year_array' => $year_arr,
            ]);                
        } 
    }   

    public function advance_submission($id, Request $request)
    {
        $count_payment_made  = 0;
        $last_payment_amount = 0;

        $user_id               = Auth::user()->id;
        $hash_id               = $id;     
        $id                    = Hashids::decode($id)[0]; 
        $contact_advance_query = ContactAdvance::query();

        if($id) {
            $contact_advance = $contact_advance_query->where('id','=', $id)->first();
            $contact         = Contact::where('id', '=', $contact_advance->contact_id)->first();
            $company_user    = CompanyUser::where('company_id','=',$contact->company_id)->get();  

            $users           = User::select('id','firstname','lastname')->where('is_active','=',0)->get();

            $total_advance_payment = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->sum('amount');
            $count_payment_made    = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->count();
            $last_payment          = ContactAdvancePayment::where('status','=', 'paid')->where('contact_advance_id', '=', $contact_advance->id)->orderBy('created_at', 'desc')->first();

            if($last_payment) {
                $last_payment_amount = $last_payment->amount;              
            }  

            $lenders = Lender::all();         
            $ca_submissions = ContactAdvanceSubmission::where('contact_advance_id', '=', $contact_advance->id)->get();     

            $emailTemplates = EmailTemplate::where('user_id', '=', $user_id)->get();         

            $documents = ContactDocs::where('contact_id', '=', $contact->id)->get();

            return view('advances.submission', [
                'hash_id' => $hash_id,
                'advance_id' => $id,
                'advance' => $contact_advance,
                'contact' => $contact,
                'company_user' => $company_user,
                'users' => $users,
                'total_advance_payment' => $total_advance_payment,
                'count_payment_made' => $count_payment_made,
                'last_payment_amount' => $last_payment_amount,
                'lenders' => $lenders,
                'ca_submissions' => $ca_submissions,
                'emailTemplates' => $emailTemplates,
                'documents' => $documents,  
            ]);                
        }  
    } 

    public function advance_participation($id, Request $request)
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

            $participations = ContactAdvanceParticipation::where('contact_advance_id','=',$contact_advance->id)->get();
            $lenders = Lender::all();

            return view('advances.participation', [
                'hash_id' => $hash_id,
                'advance_id' => $id,
                'advance' => $contact_advance,
                'contact' => $contact,
                'company_user' => $company_user,
                'participations' => $participations,
                'total_advance_payment' => $total_advance_payment,
                'count_payment_made' => $count_payment_made,
                'last_payment_amount' => $last_payment_amount, 
                'lenders' => $lenders,
            ]);                
        } 
    }

    public function send_submission(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'recipient'           => 'required',
                'subject'             => 'required',
                'content'             => 'required'   
             ]);

            $recipient_bcc = array();
            $recipient_to  = array();

            $contact_advance_id  = 0;
            $contact_advance_id  = Hashids::decode($request->input('contact_advance_id'))[0];             

            $auth_email          = Auth::user()->email;

            if($auth_email == null or !isset($auth_email)) {
                $auth_email = 'NA';
            }

            $enable_email = true;
            if($enable_email) { 

                $contact_adv_sub = new ContactAdvanceSubmission;

                $contact_adv_sub->contact_advance_id = $contact_advance_id;
                $contact_adv_sub->email_template_id  = $request->input('email_template_id');
                $contact_adv_sub->recipient = serialize($request->input('recipient'));
                $contact_adv_sub->sender    = $auth_email;
                $contact_adv_sub->subject   = $request->input('subject');
                $contact_adv_sub->content   = $request->input('content');
                $contact_adv_sub->documents = serialize($request->input('documents'));
                $contact_adv_sub->status    = 'submitted';
                $contact_adv_sub->save();

                $from_email   = 'noreply@corecms.com';
                $recipients   = $request->input('recipient');
                $subject      = $request->input('subject');
                $message      = $request->input('content');

                foreach($recipients as $recipient) {
                    $recipient_to = $recipient;
                    Mail::to($recipient_to)
                        ->send(new MailSubmission($from_email, $subject, $message));
                }     

                Session::flash('message', 'You have successfully send submission');
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();                   

            }

            Session::flash('message', 'Unable to send submission');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();  
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
            $contact_adv->balance         = $payback_amount;
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

            /* Update advance balance amount - start */
            $new_balance = 0;
            $contact_adv = ContactAdvance::find($advance_id);
            if($contact_adv) {

                if($contact_adv->balance > 0) {
                    $new_balance = $contact_adv->balance - $request->input('amount');
                } else {
                    $new_balance = $contact_adv->payback - $request->input('amount');
                }
                if($request->input('status') == 'paid') {
                    $contact_adv->balance      = $new_balance;
                    $contact_adv->save();
                }

            }
            /* Update advance balance amount - end */

            Session::flash('message', 'You have successfully add payment');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();
        } else {
            Session::flash('message', 'Unable to add payment');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();  
        }     

    }

    public function store_participation(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'lender_id'    => 'required',
                'advance_amount' => 'required|numeric',
                'loan_amount_percent' => 'required|numeric',
                'fee_amount'   => 'required|numeric',
                //'loan_amount'  => 'required|numeric',
             ]);  

            $amount_percent = 0;

            $id = Hashids::decode($request->input('advance_id'))[0];
            $advance_id = $id;     

            $advance_amount      = $request->input('advance_amount');
            $loan_amount_percent = $request->input('loan_amount_percent');

            if(isset($advance_amount) && isset($loan_amount_percent)) {
                $amount_percent = $advance_amount * ($loan_amount_percent / 100);
            }            

            $contact_adv_participation = new ContactAdvanceParticipation;
            $contact_adv_participation->contact_advance_id = $advance_id;
            $contact_adv_participation->lender_id     = $request->input('lender_id');
            $contact_adv_participation->loan_amount   = $amount_percent;
            $contact_adv_participation->loan_amount_percent = $request->input('loan_amount_percent');
            $contact_adv_participation->fee_amount    = $request->input('fee_amount');
            $contact_adv_participation->fee_percent   = $request->input('fee_percent');
            $contact_adv_participation->type          = $request->input('type');
            $contact_adv_participation->save();

            Session::flash('message', 'You have successfully add participation');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();            

        } else {
            Session::flash('message', 'Unable to add participation');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();              
        }
    }

    public function update_participation(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'lender_id'    => 'required',
                'advance_amount' => 'required|numeric',
                'loan_amount_percent' => 'required|numeric',
                'fee_amount'   => 'required|numeric',
             ]);             

            $amount_percent = 0;

            $id = Hashids::decode($request->input('advance_id'))[0];
            $participation_id = Hashids::decode($request->input('participation_id'))[0];
            
            $advance_id = $id;     

            $advance_amount      = $request->input('advance_amount');
            $loan_amount_percent = $request->input('loan_amount_percent');

            if(isset($advance_amount) && isset($loan_amount_percent)) {
                $amount_percent = $advance_amount * ($loan_amount_percent / 100);
            }                

            $contact_adv_participation = ContactAdvanceParticipation::find($participation_id);
            $contact_adv_participation->lender_id     = $request->input('lender_id');
            $contact_adv_participation->loan_amount   = $amount_percent;
            $contact_adv_participation->loan_amount_percent = $request->input('loan_amount_percent');
            $contact_adv_participation->fee_amount    = $request->input('fee_amount');
            $contact_adv_participation->fee_percent   = $request->input('fee_percent');
            $contact_adv_participation->type          = $request->input('type');
            $contact_adv_participation->save();

            Session::flash('message', 'You have successfully update participation');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();            

        } else {
            Session::flash('message', 'Unable to update participation');
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
                $previous_amount = $ca_payment->amount;
                
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

                /* Update advance balance amount - start */
                $new_balance = 0;
                $contact_adv = ContactAdvance::find($advance_id);
                if($contact_adv) {

                    if($contact_adv->balance > 0) {
                        $new_balance = ($contact_adv->balance + $previous_amount) - $request->input('amount');
                    } else {
                        $new_balance = $contact_adv->payback - $request->input('amount');
                    }
                    if($request->input('status') == 'paid') {
                        $contact_adv->balance      = $new_balance;
                        $contact_adv->save();
                    }

                }
                /* Update advance balance amount - end */                

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

    public function update_financial(Request $request) 
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

                /* Save Advance Financial Bank Statement - Start */
                $contact_adv_financial_bank_statement = ContactAdvanceFinancialBankStatementRecord::select('contact_advance_financial_bank_statement_records.id as id')->where('contact_advance_id','=', $contact_advance->id)->get();       
                if(!$contact_adv_financial_bank_statement->isEmpty()) {
                    $banks_field_array = $request->input('bank');
                    $ids_to_update      = array();

                    foreach($contact_adv_financial_bank_statement as $cafbs) {
                        $ids_to_update[] = $cafbs->id;
                    }

                    $inc = 1;
                    foreach($ids_to_update as $id_key => $cafbsr_id) {
                        $contact_adv_financial_bank_statement_update = ContactAdvanceFinancialBankStatementRecord::find($cafbsr_id);
                        if($contact_adv_financial_bank_statement_update) {
                            //$contact_adv_financial_bank_statement_update->contact_advance_id = $contact_advance->id;
                            $contact_adv_financial_bank_statement_update->name  = $request->input('bank_name');
                            $contact_adv_financial_bank_statement_update->month = $banks_field_array["'bank_month'"][$inc] != '' ? $banks_field_array["'bank_month'"][$inc] : 0;
                            $contact_adv_financial_bank_statement_update->year  = $banks_field_array["'bank_year'"][$inc];
                            $contact_adv_financial_bank_statement_update->total_deposits = $banks_field_array["'total_deposits'"][$inc];
                            $contact_adv_financial_bank_statement_update->averate_daily  = $banks_field_array["'averate_daily'"][$inc];
                            $contact_adv_financial_bank_statement_update->withdrawal     = $banks_field_array["'withdrawal'"][$inc];
                            $contact_adv_financial_bank_statement_update->ending_balance = $banks_field_array["'ending_balance'"][$inc];
                            $contact_adv_financial_bank_statement_update->deposits = $banks_field_array["'deposits'"][$inc];
                            $contact_adv_financial_bank_statement_update->days_neg = $banks_field_array["'days_neg'"][$inc];
                            $contact_adv_financial_bank_statement_update->nsf      = $banks_field_array["'nsf'"][$inc];
                            $contact_adv_financial_bank_statement_update->save(); 
                            $inc++;
                        }
                    }

                } else {

                    $banks_field_array = $request->input('bank');

                    $contact_adv_financial_bank_statement_new = '';
                    $months_inc = GlobalHelper::loadNumbers(12);

                    foreach($months_inc as $m_key => $m_inc) {
                        $contact_adv_financial_bank_statement_new = new ContactAdvanceFinancialBankStatementRecord();
                        $contact_adv_financial_bank_statement_new->contact_advance_id = $contact_advance->id;
                        $contact_adv_financial_bank_statement_new->name               = $request->input('bank_name');
                        $contact_adv_financial_bank_statement_new->month = $banks_field_array["'bank_month'"][$m_inc] != '' ? $banks_field_array["'bank_month'"][$m_inc] : 0;
                        $contact_adv_financial_bank_statement_new->year  = $banks_field_array["'bank_year'"][$m_inc];
                        $contact_adv_financial_bank_statement_new->total_deposits = $banks_field_array["'total_deposits'"][$m_inc];
                        $contact_adv_financial_bank_statement_new->averate_daily  = $banks_field_array["'averate_daily'"][$m_inc];
                        $contact_adv_financial_bank_statement_new->withdrawal     = $banks_field_array["'withdrawal'"][$m_inc];
                        $contact_adv_financial_bank_statement_new->ending_balance = $banks_field_array["'ending_balance'"][$m_inc];
                        $contact_adv_financial_bank_statement_new->deposits = $banks_field_array["'deposits'"][$m_inc];
                        $contact_adv_financial_bank_statement_new->days_neg = $banks_field_array["'days_neg'"][$m_inc];
                        $contact_adv_financial_bank_statement_new->nsf      = $banks_field_array["'nsf'"][$m_inc];
                        $contact_adv_financial_bank_statement_new->save();                      
                    }
              
                }    
                /* Save Advance Financial Bank Statement - End */  

                /* Save Advance Merchant Statement - Start */
                $contact_adv_merchant_statement = ContactAdvanceMerchantStatementRecord::select('contact_advance_merchant_statement_records.id as id')->where('contact_advance_id','=', $contact_advance->id)->get();                
                if(!$contact_adv_merchant_statement->isEmpty()) {
                    $merchant_field_array = $request->input('merchant');
                    $ids_to_update        = array();

                    foreach($contact_adv_merchant_statement as $cams) {
                        $ids_to_update[] = $cams->id;
                    }   

                    $inc = 1;
                    foreach($ids_to_update as $id_key => $cams_id) {
                        $contact_adv_merchant_statement_update = ContactAdvanceMerchantStatementRecord::find($cams_id);
                        if($contact_adv_merchant_statement_update) {
                            //$contact_adv_merchant_statement_update->contact_advance_id = $contact_advance->id;
                            $contact_adv_merchant_statement_update->name   = $request->input('merchant_name');
                            $contact_adv_merchant_statement_update->month = $merchant_field_array["'merchant_month'"][$inc] != '' ? $merchant_field_array["'merchant_month'"][$inc] : 0;
                            $contact_adv_merchant_statement_update->year  = $merchant_field_array["'merchant_year'"][$inc];
                            $contact_adv_merchant_statement_update->total_volume = $merchant_field_array["'total_volume'"][$inc];
                            $contact_adv_merchant_statement_update->visa_ms_disc  = $merchant_field_array["'visa_ms_disc'"][$inc];
                            $contact_adv_merchant_statement_update->amex     = $merchant_field_array["'amex'"][$inc];
                            $contact_adv_merchant_statement_update->charge_back_volume = $merchant_field_array["'charge_back_volume'"][$inc];
                            $contact_adv_merchant_statement_update->transaction = $merchant_field_array["'transaction'"][$inc];
                            $contact_adv_merchant_statement_update->batches = $merchant_field_array["'batches'"][$inc];
                            $contact_adv_merchant_statement_update->save();     
                            $inc++;
                        }
                    }                    

                } else {
                    $merchant_field_array = $request->input('merchant');

                    $contact_adv_merchant_statement_new = '';
                    $months_inc = GlobalHelper::loadNumbers(12);  

                    foreach($months_inc as $m_key => $m_inc) {
                        $contact_adv_merchant_statement_new = new ContactAdvanceMerchantStatementRecord();
                        $contact_adv_merchant_statement_new->contact_advance_id = $contact_advance->id;
                        $contact_adv_merchant_statement_new->name               = $request->input('merchant_name');
                        $contact_adv_merchant_statement_new->month = $merchant_field_array["'merchant_month'"][$m_inc] != '' ? $merchant_field_array["'merchant_month'"][$m_inc] : 0;
                        $contact_adv_merchant_statement_new->year  = $merchant_field_array["'merchant_year'"][$m_inc];
                        $contact_adv_merchant_statement_new->total_volume = $merchant_field_array["'total_volume'"][$m_inc];
                        $contact_adv_merchant_statement_new->visa_ms_disc  = $merchant_field_array["'visa_ms_disc'"][$m_inc];
                        $contact_adv_merchant_statement_new->amex     = $merchant_field_array["'amex'"][$m_inc];
                        $contact_adv_merchant_statement_new->charge_back_volume = $merchant_field_array["'charge_back_volume'"][$m_inc];
                        $contact_adv_merchant_statement_new->transaction = $merchant_field_array["'transaction'"][$m_inc];
                        $contact_adv_merchant_statement_new->batches = $merchant_field_array["'batches'"][$m_inc];
                        $contact_adv_merchant_statement_new->save();                      
                    }                                      

                }
                /* Save Advance Merchant Statement - End */

                //exit;

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

    public function ajax_load_participation_loan_amount(Request $request)
    {
        $advance_amount = $request->input('advance_amount');
        $loan_amount_percent = $request->input('loan_amount_percent');

        if(isset($advance_amount) && isset($loan_amount_percent)) {
            $amount_percent = $advance_amount * ($loan_amount_percent / 100);
        }

        return view('advances.ajax.ajax_load_participation_loan_amount',[
            'amount_percent' => $amount_percent
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
    
    public function destroy_participation(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $ca = ContactAdvanceParticipation::find($id);

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
