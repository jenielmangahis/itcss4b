<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\MailMessaging;
use App\Contact;
use App\EmailTemplate;

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
                $recipients = implode(",", $request->input('recipient'));
                if( !empty($request->input('bcc')) ){
                    $bcc = implode(",", $request->input('bcc'));
                }
                if( !empty($request->input('cc')) ){
                    $cc = implode(",", $request->input('cc'));
                }

                $user_id       = Auth::user()->id;
                $mailMessaging = new MailMessaging;
                $mailMessaging->user_id = $user_id;
                $mailMessaging->recipient = $recipients;
                $mailMessaging->date = date("Y-m-d H:i:s");
                $mailMessaging->status = 1;
                $mailMessaging->subject = $request->input('content');
                $mailMessaging->cc = $cc;
                $mailMessaging->bcc = $bcc;
                $mailMessaging->content = $request->input('content');
                $mailMessaging->save();
                $name    = '';
                //$name    = 'Bryann Revina';
                $email   = 'bryann.revina@gmail.com';
                $subject = 'This is a test laravel email';
                $message = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry';

                Mail::to('jeniel.mangahis@gmail.com')
                    ->cc($cc)
                    ->bcc($bcc)
                    ->send(new MailNotification($name, $recipients, $request->input('subject'), $request->input('content'))); // 'MailNotification' class is located on app/Mail folder
                
                /*Mail::to($request->user())
                    ->cc($moreUsers)
                    ->bcc($evenMoreUsers)
                    ->later($when, new OrderShipped($order));*/                    


            }

            Session::flash('message', 'Email Sent');
            Session::flash('alert_class', 'alert-success');
            return redirect('mail_messaging');

        }else{
            Session::flash('message', 'Unable to send email');
            Session::flash('alert_class', 'alert-danger');  
            return redirect('mail_messaging');
        }
    }
}
