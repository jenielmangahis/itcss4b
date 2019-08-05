<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\ContactCallTracker;
use App\CompanyUser;
use App\ContactEvent;
use App\Contact;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class CallTrackerController extends Controller
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

    public function ajax_loadactivity_history_tab_list(Request $request)
    {
    	$hash_id = $request->input('id');
    	$id  = Hashids::decode($hash_id)[0];

    	$call_log_activity_history = ContactCallTracker::where('contact_id','=',$id)->get();
        return view('contact.ajax_loadactivity_history_tab_list',[
            'call_log_activity_history' => $call_log_activity_history,
        ]);
    }

    public function ajax_followup_call_user_dropdown(Request $request)
    {
    	$hash_id = $request->input('id');
    	$id  = Hashids::decode($hash_id)[0];

    	$contact = Contact::where('id','=', $id)->first();

    	if($contact) {
    		$company_users = CompanyUser::where('company_id', '=', $contact->company_id)->get();
    	}

    	
        return view('contact.ajax_followup_call_user_dropdown',[
            'company_users' => $company_users,
        ]);
    }    

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
        	Session::flash('calltrackercontactid', $request->input('contact_id'));
            $this->validate($request, [
                'call_type'          => 'required',
                'call_result'      	 => 'required',
                'event_type_id'      => 'required',
                'call_update_status' => 'required',
                'call_minutes' 		 => 'required|numeric',
                'call_seconds' 		 => 'required|numeric',
             ]);

            $contact_id = 0;
            $hash_contact_id = 0;
            if(empty($contact_id)) {
            	$hash_contact_id = $request->input('contact_id');
	            $contact_id = $request->input('contact_id');
	            $contact_id = Hashids::decode($contact_id)[0]; 
            }

            $user_id      = Auth::user()->id;

            $call_tracker              	= new ContactCallTracker;
            $call_tracker->user_id     	= $user_id;
            $call_tracker->contact_id  	= $contact_id;
            $call_tracker->call_type    = $request->input('call_type');
            $call_tracker->call_result  = $request->input('call_result');
            $call_tracker->call_minutes = $request->input('call_minutes');
            $call_tracker->call_seconds = $request->input('call_seconds');
            $call_tracker->notes        = $request->input('notes');
            $call_tracker->event_type_id = $request->input('event_type_id');   
            $call_tracker->call_update_status = $request->input('call_update_status');
            $call_tracker->save();

            Session::flash('calltrackermodal', 'yes');
            Session::flash('calltrackercontactid', $hash_contact_id);
            Session::flash('message', 'You have successfully add call log activity');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();

        }else{
        	Session::flash('calltrackermodal', 'yes');
            Session::flash('message', 'Unable to add call log activity');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();
        }
    }    

    public function store_followup(Request $request) 
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'event_date'      => 'required',
                'description'     => 'required',
                'event_time'      => 'required'
             ]);

            if( $request->input('event_date') ) {
                $event_date    = $request->input('event_date');
                $last_space_position = strrpos($event_date, ' ');
                $event_date    = substr($event_date, 0, $last_space_position);   
                $event_date = date('Y-m-d', strtotime($event_date));
            }     

	    	$hash_contact_id = $request->input('contact_id');
	    	$contact_id      = Hashids::decode($hash_contact_id)[0];
	    	$contact         = Contact::where('id','=', $contact_id)->first();

	    	$title = "Followup Call";
	    	if($contact) {
	    		$title = "Followup Call - [" . $contact->firstname . " " . $contact->lastname . "]";
	    	}                   

            $contact_event              = new ContactEvent;
            $contact_event->title       = $title;
            $contact_event->event_date  = $event_date;
            $contact_event->event_time  = date( "H:i:s",strtotime($request->input('event_time')));
            $contact_event->event_type_id = $request->input('event_type_id');
            $contact_event->user_id       = $request->input('user_id');
            $contact_event->description   = $request->input('description');
            $contact_event->save();

            Session::flash('calltrackermodal', 'yes');
            Session::flash('calltrackercontactid', $hash_contact_id);
            Session::flash('message', 'You have successfully add followup call');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();

        }else{
        	Session::flash('calltrackermodal', 'yes');
            Session::flash('message', 'Unable to add followup call');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();
        }    	
    }




}
