<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Contact;
use App\ContactBusinessInformation;
use App\ContactBrokerInformation;
use App\ContactLoanInformation;
use App\Workflow;
use App\ContactEvent;
use App\CompanyUser;
use App\EventType;
use App\MailMessaging;
use App\EmailTemplate;

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
                $contact_events = $contact_event_query->paginate(10);
            }            
        } else {
            $contact_events = ContactEvent::paginate(10);
        }        
        /*
         * For contact event - end 
        */

        if($contact) {
        	$workflow_status = Workflow::where('id', '=', $contact->status)->first();
        }

        $company_users = CompanyUser::where('company_id', '=', $contact->company_id)->get();
        $event_types   = EventType::all();

        $upcoming_events = "";

        $event_start = date("Y-m-d", strtotime(date('Y-m-d') . ' +1 day'));
        $event_end   = date("Y-m-d", strtotime($event_start . ' +3 day'));

        $upcoming_events = ContactEvent::where('event_date', '>=', $event_start)
                     ->where('event_date', '<=', $event_end)->get();

        $todays_events = ContactEvent::where('event_date', '=', date("Y-m-d"))->get();

        $user_id  = Auth::user()->id;

        /*
         * For emails - start
        */

        $search_by_mail    = $request->input('search_by_mail');
        $search_field_mail = $request->input('search_field_mail');  
        if($search_by_mail != '' && $search_field_mail != '') {
            $mail_messaging_query = MailMessaging::query();
            $mail_messaging_query = $mail_messaging_query->where('mail_messaging.'.$search_by_mail, 'like', '%' . $search_field_mail . '%');
            $mail_messaging_query = $mail_messaging_query->where('mail_messaging.contact_id',$id);
            $mail_messaging = $mail_messaging_query->paginate(15);
        } else {
            $mail_messaging_query = MailMessaging::query();
            $mail_messaging_query = $mail_messaging_query->where('mail_messaging.contact_id',$id);
            $mail_messaging = $mail_messaging_query->paginate(20);
        }

        $emailTemplates = EmailTemplate::where('user_id', '=', $user_id)->get();
        $contacts = Contact::where('user_id','=', $user_id)->get();
        /*
         * For emails event - end 
        */
        return view('contact.dashboard.index',[
        	'contact_id' => $contact_id,
        	'contact' => $contact,
            'contacts' => $contacts,
            'emailTemplates' => $emailTemplates,
        	'business_info' => $business_info,
        	'workflow_status' => $workflow_status,
        	'contact_events' => $contact_events,
        	'company_users' => $company_users,
        	'event_types' => $event_types,
            'search_field_event' => $search_field_event,
            'search_field_mail' => $search_field_mail,
            'upcoming_events' => $upcoming_events,
            'todays_events' => $todays_events,
            'mail_messaging' => $mail_messaging,
        ]); 
    }     
}
