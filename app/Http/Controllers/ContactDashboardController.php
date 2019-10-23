<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Contact;
use App\ContactBusinessInformation;
use App\ContactBrokerInformation;
use App\ContactLoanInformation;
use App\ContactCallTracker;
use App\Workflow;
use App\ContactEvent;
use App\CompanyUser;
use App\EventType;
use App\NoteType;
use App\MailMessaging;
use App\EmailTemplate;
use App\ContactNote;
use App\ContactBankAccount;
use App\ContactCreditCard;
use App\ContactTask;
use App\State;
use App\ContactDocs;
use App\ContactHistory;
use App\ContactAdvance;
use App\ContactUser;
use App\User;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactDashboardController extends Controller
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

    public function index($id, Request $request)
    {
    	$contact_id = $id;
        $id = Hashids::decode($id)[0];
        $contact = Contact::find($id); 
        $business_info = ContactBusinessInformation::where('contact_id','=', $id)->first();

        /*
         * For contact event - start
        */
        //$contact_events = ContactEvent::all();
        $search_by_event    = $request->input('search_by');
        $search_field_event = $request->input('search_field');  
        if($search_by_event != '' && $search_field_event != '') {
            $contact_event_query = ContactEvent::query();

            if($search_by_event != '' && $search_field_event != '') {
                $contact_event_query = $contact_event_query->where('contact_events.'.$search_by_event, 'like', '%' . $search_field_event . '%');
                $contact_event_query = $contact_event_query->where('contact_id','=', $contact->id);
                $contact_events = $contact_event_query->paginate(10);
            }            
        } else {
            //$contact_events = ContactEvent::paginate(10);
            $contact_events = ContactEvent::where('contact_id','=', $contact->id)->paginate(10);
        }        
        /*
         * For contact event - end 
        */

        if($contact) {
        	$workflow_status = Workflow::where('id', '=', $contact->status)->first();
        }

        $company_users = CompanyUser::where('company_id', '=', $contact->company_id)->get();
        $event_types   = EventType::all();
        $note_types   = NoteType::all();

        $upcoming_events = "";

        $event_start = date("Y-m-d", strtotime(date('Y-m-d') . ' +1 day'));
        $event_end   = date("Y-m-d", strtotime($event_start . ' +3 day'));

        $upcoming_events = ContactEvent::where('event_date', '>=', $event_start)
                     ->where('contact_id','=', $contact->id)
                     ->where('event_date', '<=', $event_end)->get();

        $todays_events = ContactEvent::where('event_date', '=', date("Y-m-d"))->where('contact_id','=', $contact->id)->get();

        $user_id  = Auth::user()->id;

        $call_log_activity_history = ContactCallTracker::where('contact_id','=',$contact->id)->paginate(10);

        /*
         * For emails - start
        */

        $search_by_mail    = $request->input('search_by_mail');
        $search_field_mail = $request->input('search_field_mail');  
        if($search_by_mail != '' && $search_field_mail != '') {
            $mail_messaging_query = MailMessaging::query();
            $mail_messaging_query = $mail_messaging_query->where('mail_messaging.'.$search_by_mail, 'like', '%' . $search_field_mail . '%');
            $mail_messaging_query = $mail_messaging_query->where('mail_messaging.contact_id','=', $contact->id);
            $mail_messaging = $mail_messaging_query->paginate(20);
        } else {
            $mail_messaging_query = MailMessaging::query();
            $mail_messaging_query = $mail_messaging_query->where('mail_messaging.contact_id','=', $contact->id);
            $mail_messaging = $mail_messaging_query->paginate(20);
        }

        $emailTemplates = EmailTemplate::where('user_id', '=', $user_id)->get();
        if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
            $contacts = Contact::where('user_id','=', $user_id)->get();
        }else{
            $contacts = Contact::all();
        }
                
        /*
         * For emails - end 
        */

        /*
         * Contact Note
        */
            $contact_notes_query = ContactNote::query();
            if($contact) {
                $contact_notes_query = $contact_notes_query->where('contact_id','=', $contact->id);
            }
            $contact_notes = $contact_notes_query->orderBy('created_at', 'desc')->paginate(10);
        /*
         * Contact Note - end
        */
        $states   = State::all();

        /*
         * Contact Task - Start
        */
        $search_by_task    = $request->input('search_by');
        $search_task_field = $request->input('search_task_field');  
        if($search_by_task != '' && $search_task_field != '') {
            $contact_task_query = ContactTask::query();

            if($search_by_task != '' && $search_task_field != '') {
                $contact_task_query = $contact_task_query->where('contact_tasks.'.$search_by_task, 'like', '%' . $search_task_field . '%');
                $contact_task_query = $contact_task_query->where('contact_id','=', $contact->id);
                if(UserHelper::isCompanyUser(Auth::user()->group_id)) { 
                     $contact_task_query = $contact_task_query->where('user_id','=', $user_id)->orWhere('assigned_user_id','=', $user_id);
                }                
                $contact_tasks = $contact_task_query->paginate(10);
            }            
        } else {

            $contact_task_query = ContactTask::query();
            if($contact) {
                $contact_task_query = $contact_task_query->where('contact_id','=', $contact->id);
            }

            if(UserHelper::isCompanyUser(Auth::user()->group_id)) { 
                 $contact_task_query = $contact_task_query->where('user_id','=', $user_id)->orWhere('assigned_user_id','=', $user_id);
            }

            $contact_tasks = $contact_task_query->orderBy('created_at', 'desc')->paginate(10);                      
        }
        /*
         * Contact Task - End
        */  

        /*
         * Contact Advance - Start
        */         
            $search_by_advance       = $request->input('search_by');
            $search_advance_field = $request->input('search_advance_field');
            $contact_advances = array();

            if($search_by_advance != '' && $search_advance_field != '') {
                $contact_advance_query = ContactAdvance::query();
                $contact_advance_query = $contact_advance_query->where($search_by_advance, 'like', '%' . $search_advance_field . '%');
                $contact_advance_query = $contact_advance_query->where('contact_id','=', $contact->id);               
                $contact_advances = $contact_advance_query->orderBy('created_at', 'desc')->paginate(10);
            } else {
                $contact_advance_query = ContactAdvance::query();
                if($contact) {
                    $contact_advance_query = $contact_advance_query->where('contact_id','=', $contact->id);
                }                
                $contact_advances = $contact_advance_query->orderBy('created_at', 'desc')->paginate(10);
            }
            
        /*
         * Contact Advance - End
        */             

        /*
         * Contact History - Start
        */ 

        $contact_history_query = ContactHistory::query(); 
        
        if($contact) {
            $contact_history_query = $contact_history_query->where('contact_id','=', $contact->id); 
        }         
        $contact_history = $contact_history_query->orderBy('created_at', 'desc')->paginate(20);  

        /*
         * Contact History - End
        */ 

        /*
         * For bank account - Start
        */
        $bankAccounts = new ContactBankAccount();
        $bankAccountAccountTypes = $bankAccounts->optionsAccountTypes();
        $bank_account_id = 0;
        /*
         * For bank account - end
        */        

        $contactBankAccount = ContactBankAccount::where('contact_id','=', $id)->first();
        if( $contactBankAccount ){
            $bank_account_id = $contactBankAccount->id;            
            $data_bank_account = [
                'routing_number'          => $contactBankAccount->routing_number,
                'is_check_paying_client' => $contactBankAccount->is_check_paying_client,
                'account_number'         => $contactBankAccount->account_number,
                'account_type'      => $contactBankAccount->account_type,
                'name_on_account' => $contactBankAccount->name_on_account,
                'bank_name'          => $contactBankAccount->bank_name,
                'address'        => $contactBankAccount->address,
                'city'       => $contactBankAccount->city,
                'state_id'          => $contactBankAccount->state_id,
                'zip' => $contactBankAccount->zip
            ];
        }else{
            $data_bank_account = [
                'routing_number'          => '',
                'account_number'         => '',
                'is_check_paying_client' => 0,
                'account_type'      => '',
                'name_on_account' => '',
                'bank_name'          => '',
                'address'        => '',
                'city'       => '',
                'state_id'          => '',
                'zip' => ''
            ];
        }

        /*
         * For credit card - start
        */
        $creditCards = new ContactCreditCard();
        $creditCardDebitCredit = $creditCards->optionsDebitCredit();
        $creditCardCardTypes   = $creditCards->optionsCardTypes();
        $contact_credit_card_id = 0;

        $contactCreditCard = ContactCreditCard::where('contact_id','=', $id)->first();
        if( $contactCreditCard ){
            $contact_credit_card_id = $contactCreditCard->id;
            $data_contact_credit_card = [
                'debit_credit' => $contactCreditCard->debit_credit,
                'card_type' => $contactCreditCard->card_type,
                'card_issuer' => $contactCreditCard->card_issuer,
                'name_on_card' => $contactCreditCard->name_on_card,
                'card_number' => $contactCreditCard->card_number,
                'expiration_date_month' => $contactCreditCard->expiration_date_month,
                'expiration_date_year' => $contactCreditCard->expiration_date_year,
                'address' => $contactCreditCard->address,
                'address2' => $contactCreditCard->address2,
                'city' => $contactCreditCard->city,
                'state_id' => $contactCreditCard->state_id,
                'zip' => $contactCreditCard->zip,
            ];
        }else{
            $data_contact_credit_card = [
                'debit_credit' => '',
                'card_type' => '',
                'card_issuer' => '',
                'name_on_card' => '',
                'card_number' => '',
                'expiration_date_month' => '',
                'expiration_date_year' => '',
                'address' => '',
                'address2' => '',
                'city' => '',
                'state_id' => '',
                'zip' => '',
            ];
        }

        /*
         * Credit Card - end
        */

        /*
         * For docs - start
        */  
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
            //$contact_events = ContactEvent::paginate(10);
            $contactDocs = ContactDocs::where('contact_id', '=', $contact->id)->paginate(10);
        }

        $contactDoc = new ContactDocs();
        $documentTypes = $contactDoc->documentTypes();

        /*
         * Docs - end
        */

        /*
         * Contact User - start
        */
            $contactUser = ContactUser::where('contact_id','=', $id)->first();
            $has_client_portal = false;
            $userContactInfo   = array();
            if( $contactUser ){
                $has_client_portal = true;
                $userContactInfo = User::where('id', '=', $contactUser->user_id)->first();
            }
        /*
         * Contact User - end
        */

        return view('contact.dashboard.index',[
        	'contact_id' => $contact_id,            
        	'contact' => $contact,            
            'bankAccountAccountTypes' => $bankAccountAccountTypes,
            'contacts' => $contacts,
            'emailTemplates' => $emailTemplates,
        	'business_info' => $business_info,
        	'workflow_status' => $workflow_status,
        	'contact_events' => $contact_events,
        	'company_users' => $company_users,
        	'event_types' => $event_types,
            'note_types' => $note_types,
            'search_field_event' => $search_field_event,
            'search_field_mail' => $search_field_mail,
            'search_task_field' => $search_task_field,
            'upcoming_events' => $upcoming_events,
            'todays_events' => $todays_events,
            'mail_messaging' => $mail_messaging,
            'call_log_activity_history' => $call_log_activity_history,
            'contact_notes' => $contact_notes,
            'data_bank_account' => $data_bank_account,
            'data_contact_credit_card' => $data_contact_credit_card,
            'bank_account_id' => $bank_account_id,
            'creditCardDebitCredit' => $creditCardDebitCredit,
            'creditCardCardTypes' => $creditCardCardTypes,
            'contact_credit_card_id' => $contact_credit_card_id,
            'contact_tasks' => $contact_tasks,
            'states' => $states,
            'documentTypes' => $documentTypes,
            'contactDocs' => $contactDocs,
            'search_field_documents' => $search_field_documents,
            'contact_history' => $contact_history,
            'contact_advances' => $contact_advances,
            'search_advance_field' => $search_advance_field,
            'search_by_advance' => $search_by_advance,
            'userContactInfo' => $userContactInfo,
            'has_client_portal' => $has_client_portal,
            'group_id' => Auth::user()->group_id

        ]); 
    }     
}
