<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Contact;
use App\ContactHistory;
use App\ContactAssignedUser;

use UserHelper;
use GlobalHelper;

use App\Mail\MailIdleContact;

use View;
use Hash;
use Hashids;

use Session;

class CronJobController extends Controller
{
    public function __construct()
    {
               
    }

    public function idle_contact()
    {
    	$idle_data  = array();
        $contacts   = Contact::select('id')->get();

        if(!$contacts->isEmpty()) {
          	foreach($contacts as $contact) {
                $contact_id = $contact['id'];
                $contact_history = ContactHistory::select('contact_id','created_at')
                						->where('contact_id','=', $contact_id)
                                        ->latest('created_at')
                                        ->first();

                if($contact_history) {
                      
                      $last_activity_date = $contact_history->created_at;

                      if(strtotime($last_activity_date) < strtotime('-15 days')) {
                            $idle_data[] = $contact_history;
                      }     

                }
          	}

          	$idle_contact_with_assigned_user = array();
          	$inc_idle = 1;
          	foreach($idle_data as $idata) {
          		$contact_id = $idata->contact_id;
          		$assigned_user = ContactAssignedUser::where('contact_id','=', $contact_id)->get();

          		$idle_contact_with_assigned_user[$inc_idle]['contact_name'] = $idata->contact->firstname . " " . $idata->contact->lastname;
          		$idle_contact_with_assigned_user[$inc_idle]['contact_id']   = $idata->contact->id;

          		$assigned_user_arr = array();
          		if($assigned_user) {
          			$inc = 1;
	          		foreach($assigned_user as $au) {
	          			/*
						 * Note: here you can add validation for user group id (must be rtr member only)
	          			*/
	          			$assigned_user_arr[$inc]['name']  = $au->user->firstname . " " . $au->user->lastname;
	          			$assigned_user_arr[$inc]['email'] = $au->user->email;
	          		$inc++;
	          		}
	          		$idle_contact_with_assigned_user[$inc_idle]['assigned_users'] = $assigned_user_arr;
          		}

          	$inc_idle++;
          	}
          		
          	foreach($idle_contact_with_assigned_user as $idle_contact) {
          		if(!empty($idle_contact['assigned_users'])) {

          			$idle_contact_users = $idle_contact['assigned_users'];
          			foreach($idle_contact_users as $idl_user) {
          				$recipients = array();
          				$contact_id   = $idle_contact['contact_id'];
          				$contact_name = $idle_contact['contact_name'];
          				$a_email = $idl_user['email'];
          				$a_name  = $idl_user['name'];

				        //Send email notification for idle contacts
				        $from_email   = 'noreply@corecrm.com';
				        $subject 	  = 'coreCRM : Idle Contacts';
				        $recipients[$a_email] = $a_email;
				        $message      = "<p>Contact belong to <b>". $contact_name ."</b>, is already idle for 15 days, please click below for additional details</p>";
				        $contact_url  = url('contact_dashboard/' . Hashids::encode($contact_id)); 

				        Mail::to($recipients)
				                ->send(new MailIdleContact($from_email, $subject, $message, $contact_url)); 
          			}
          		}
          	}         	


        }
    }    

}
