<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\ContactNote;
use App\Contact;
use App\ContactTask;
use App\ContactHistory;
use App\User;

use UserHelper;
use GlobalHelper;

use App\Mail\ContactNoteNotification;

use View;
use Hash;
use Hashids;

use Session;

class ContactNoteController extends Controller
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

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'note_title'      => 'required',
                'note_content'    => 'required',
                //'cc_emails'       => 'email',
             ]);

            
            $cc_emails           = "";
            $cc_emails_serialize = "";
            if(!empty($request->input('cc_emails'))) {
            	$cc_emails = json_decode($request->input('cc_emails'));
            	$cc_emails_serialize = serialize($cc_emails);
            }

            $contact_id = $request->input('contact_id');
            $contact_id = Hashids::decode($contact_id)[0];

            $contact_note               = new ContactNote;
            $contact_note->contact_id   = $contact_id;  
            $contact_note->note_type_id = $request->input('note_type_id');
            $contact_note->note_title   = $request->input('note_title');
            $contact_note->note_content = $request->input('note_content');
            $contact_note->notify_user_id = $request->input('notify_user_id');
            $contact_note->cc_emails      = $cc_emails_serialize;
            $contact_note->save();

            /*
			 * Send notification
            */

            $is_enable_email = true;
            if($is_enable_email) {

	            $notify_user_id = $request->input('notify_user_id');
	            $notify_user = User::find($notify_user_id);
	            if($notify_user) {

	            	$contact_name = "";
		            $contact      = Contact::find($contact_id);
		            if($contact) {
		            	$contact_name = $contact->firstname . " " . $contact->lastname;
		            }

		            $name    = Auth::user()->firstname . " " . Auth::user()->lastname;
		            $to_email   = $notify_user->email;
		            $from_email = 'admin@coreCRM.coms';
		            $subject = 'Contact Note Notification';

		            if($contact_name != "") {
		            	$message = 'This is to notify you that <strong>' . $name . '</strong> add a new note to contact: ' . $contact_name;  
		            } else { $message = 'This is to notify you that <strong>' . $name . '</strong> add a new note'; }

		            if( !empty($cc_emails) ) {
			            Mail::to($to_email)
			            	->cc($cc_emails)
			                ->send(new ContactNoteNotification($name, $to_email, $from_email, $subject, $message)); 
		            } else {
			            Mail::to($to_email)
			                ->send(new ContactNoteNotification($name, $to_email, $from_email, $subject, $message)); 		            	
		            }

	            }       

            }

            /*
			 * Send notification - end
            */

            //Adding history - Start
            if($contact_note) {
                $user_id    = Auth::user()->id;
                $contact_id = Hashids::decode($request->input('contact_id'))[0];
                $ch = new ContactHistory;
                $ch->user_id       = $user_id;
                $ch->contact_id    = $contact_id;
                $ch->company_id    = 0;
                $ch->title         = "Add New Note";
                $ch->description   = "Note Title: " . $request->input('note_title') . ", Note ID: " . $contact_note->id;
                $ch->module        = "Notes";
                $ch->save();
            }
            //Adding history - End            

            Session::flash('message', 'You have successfully created note');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();

        }else{
            Session::flash('message', 'Unable to create new note');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();
        }
    } 

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $note = ContactNote::find($id);

            if($note) {   
                $contact_id = $note->contact_id;
                $note_id    = $note->id;
                $note->delete();

                //Adding history - Start
                if($note) {
                    $user_id    = Auth::user()->id;
                    $ch = new ContactHistory;
                    $ch->user_id       = $user_id;
                    $ch->contact_id    = $contact_id;
                    $ch->company_id    = 0;
                    $ch->title         = "Delete Note";
                    $ch->description   = "Note ID: " . $note_id;
                    $ch->module        = "Notes";
                    $ch->save();
                }
                //Adding history - End    

                Session::flash('message', "Note Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();
            }
        }
    }     

}
