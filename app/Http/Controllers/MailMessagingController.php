<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\MailMessaging;
use App\Contact;
use App\EmailTemplate;
use App\ContactTask;
use App\ContactHistory;

/*
 * Note: below are class file the use for sending email. File is located in 'app/Mail' folder
*/
use App\Mail\MailContact;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class MailMessagingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');       
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'mail_messaging';
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
            $mail_messaging_query = MailMessaging::query();

            if($search_by != '' && $search_field != '') {
                $mail_messaging_query = $mail_messaging_query->where('mail_messaging.'.$search_by, 'like', '%' . $search_field . '%');
                $mail_messaging = $mail_messaging_query->paginate(15);
            }            
        } else {
            $mail_messaging = MailMessaging::paginate(15);
        }

        return view('mail_messaging.index',[
        	'mail_messaging' => $mail_messaging,
            'search_field' => $search_field
        ]); 
    }

    public function create()
    {
    	$user_id  = Auth::user()->id;
    	$contacts = Contact::where('user_id','=', $user_id)->get();
        $emailTemplates = EmailTemplate::where('user_id', '=', $user_id)->get();
        return view('mail_messaging.create', [
            'contacts' => $contacts,
            'emailTemplates' => $emailTemplates
        ]);
    }

    public function send(Request $request)
    {
    	if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'recipient'           => 'required',
                'subject'			  => 'required',
                'content'			  => 'required'   
             ]);

            $send_cc = array();
            $send_bcc = array();

            $auth_email  = Auth::user()->email;

            if($auth_email == null or !isset($auth_email)) {
                $auth_email = 'NA';
            }

            $enable_email = true;
            if($enable_email) {         

                $cc  = '';
                $bcc = '';
                $recipients = array();
                if( !empty($request->input('bcc')) ){
                    $bcc = implode(",", $request->input('bcc'));
                }
                if( !empty($request->input('cc')) ){
                    $cc = implode(",", $request->input('cc'));
                }

                $contact_id = Hashids::decode($request->input('contact_id'))[0];

                foreach( $request->input('recipient') as $key => $value ) {
                    $contact = Contact::where('id', '=', $value)->first();

                    if( $contact ) {
                        $date = date("Y-m-d H:i:s");
                        $recipients[$contact->email] = $contact->email;
                        $user_id       = Auth::user()->id;

                        $mailMessaging = new MailMessaging;
                        $mailMessaging->contact_id = $contact_id;
                        $mailMessaging->user_id    = $user_id;
                        $mailMessaging->recipient  = $contact->email;
                        $mailMessaging->date       = $date;
                        $mailMessaging->date_last_opened = $date;
                        $mailMessaging->status     = 1;
                        $mailMessaging->subject    = $request->input('subject');
                        $mailMessaging->cc         = $cc;
                        $mailMessaging->bcc        = $bcc;
                        $mailMessaging->content    = $request->input('content');
                        $mailMessaging->sender     = $auth_email;
                        $mailMessaging->save();
                    }
                }

                $from_email   = 'noreply@corecms.com';
                $send_cc      = $request->input('cc');
                $send_bcc     = $request->input('bcc');
                $subject      = $request->input('subject');
                $message      = $request->input('content');

                if(empty($send_cc) && empty($send_bcc)) {
                    Mail::to($recipients)
                        ->send(new MailContact($from_email, $subject, $message)); 
                }elseif(empty($send_cc) && empty($send_bcc)) {
                    Mail::to($recipients)
                        ->cc($send_cc)
                        ->bcc($send_bcc)
                        ->send(new MailContact($from_email, $subject, $message));                        
                }elseif(!empty($send_cc) && empty($send_bcc)) {
                    Mail::to($recipients)
                        ->cc($send_cc)
                        ->send(new MailContact($from_email, $subject, $message));    
                }elseif(empty($send_cc) && !empty($send_bcc)) {
                    Mail::to($recipients)
                        ->bcc($send_bcc)
                        ->send(new MailContact($from_email, $subject, $message));                            
                }

                //Adding history - Start
                if($mailMessaging) {
                    $user_id    = Auth::user()->id;
                    $contact_id = Hashids::decode($request->input('contact_id'))[0];
                    $ch = new ContactHistory;
                    $ch->user_id       = $user_id;
                    $ch->contact_id    = $contact_id;
                    $ch->company_id    = 0;
                    $ch->title         = "Send Email";
                    //$ch->description   = "";
                    $ch->module        = "Emails";
                    $ch->save();
                }
                //Adding history - End                        
     
            }

            Session::flash('message', 'Email Sent');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();

        }else{
            Session::flash('message', 'Unable to send email');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();
        }
    }

    public function ajax_update_last_opened(Request $request)
    {
        $date_last_opened = date("Y-m-d H:i:s");
        $mailMessaging = MailMessaging::where('id', '=', $request->input('mail_messaging_id'))->first();
        $mailMessaging->date_last_opened = $date_last_opened;
        $mailMessaging->save();

        $json_data = ['date_last_opened' => $date_last_opened];
        echo json_encode($json_data);
        exit;
    }
}
