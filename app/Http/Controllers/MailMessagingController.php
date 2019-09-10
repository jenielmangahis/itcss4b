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
                foreach( $request->input('recipient') as $key => $value ){
                    $contact = Contact::where('id', '=', $value)->first();
                    if( $contact ) {
                        $date = date("Y-m-d H:i:s");
                        $recipients[$contact->email] = $contact->email;
                        $user_id       = Auth::user()->id;
                        $mailMessaging = new MailMessaging;
                        $mailMessaging->contact_id = $contact->id;
                        $mailMessaging->user_id    = $user_id;
                        $mailMessaging->recipient  = $contact->email;
                        $mailMessaging->date       = $date;
                        $mailMessaging->date_last_opened = $date;
                        $mailMessaging->status     = 1;
                        $mailMessaging->subject    = $request->input('subject');
                        $mailMessaging->cc         = $cc;
                        $mailMessaging->bcc        = $bcc;
                        $mailMessaging->content    = $request->input('content');
                        $mailMessaging->sender     = "NA";
                        $mailMessaging->save();
                    }
                }

                    /*Mail::to('jeniel.mangahis@gmail.com')
                        ->cc($cc)
                        ->bcc($bcc)
                        ->send(new MailNotification($name, $recipients, $request->input('subject'), $request->input('content'))); */
                        // 'MailNotification' class is located on app/Mail folder      
                
                    /*$from_email = 'coreCMS@gmail.com';
                    $to      = $contact->email;
                    $name    = $contact->firstname . " " . $contact->lastname;
                    $subject = $request->input('subject');
                    $message = $request->input('content');*/

                    $from_email = 'coreCMS@gmail.com';
                    $to      = array('bryann.revina@gmail.com','jeniel@test.com');
                    $cc      = array('marvin@test.com');
                    $bcc     = array('lily@test.com');
                    $name    = 'Bryann Revina';
                    $subject = $request->input('subject');
                    $message = $request->input('content');

                    Mail::to($recipients)
                        ->cc($cc)
                        ->bcc($bcc)
                        ->send(new MailContact($name, $from_email, $subject, $message)); 

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
