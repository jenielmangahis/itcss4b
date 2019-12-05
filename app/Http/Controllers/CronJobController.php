<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Contact;
use App\ContactHistory;
use App\ContactAssignedUser;

use UserHelper;
use GlobalHelper;

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
    	$idle_data = array();
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
          	foreach($idle_data as $idata) {
          		$contact_id = $idata->contact_id;
          		$assigned_user = ContactAssignedUser::where('contact_id','=', $contact_id)->get();

          		$idle_contact_with_assigned_user['contact_name'] = $idata->contact->firstname . " " . $idata->contact->lastname;
          		$idle_contact_with_assigned_user['contact_id']   = $idata->contact->id;

          		$assigned_user_arr = array();
          		if($assigned_user) {
          			$inc = 1;
	          		foreach($assigned_user as $au) {
	          			$assigned_user_arr[$inc]['name']  = $au->user->firstname . " " . $au->user->lastname;
	          			$assigned_user_arr[$inc]['email'] = $au->user->email;
	          		$inc++;
	          		}
	          		$idle_contact_with_assigned_user['assigned_users'] = $assigned_user_arr;
          		}



          		echo '<pre>';
          		print_r($idle_contact_with_assigned_user);
          		//print_r($assigned_user->toArray());
          		echo '</pre>';
          		echo '<hr />';
          	}


        }
    }    

}
