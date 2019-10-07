<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Contact;
use App\ContactUser;
use App\Mail\MailContact;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactUserController extends Controller
{
    public function store(Request $request)
    {
    	if ($request->isMethod('post'))
        {

            if(!$this->validateUsername($request->input('contact_username'))) {
                Session::flash('message', 'Username already exist.');
                Session::flash('alert_class', 'alert-danger');
                return redirect()->back();	
            }

            if($request->input('contact_password') == $request->input('contact_repassword')) {
            	$contact_id = Hashids::decode($request->input('contact_id'))[0];
            	$contact    = Contact::find($contact_id); 

                $user = new User;
                $user->group_id   	 = UserHelper::customerGroupId();
                $user->firstname     = ucfirst($contact->firstname);
                $user->lastname      = ucfirst($contact->lastname);
                $user->nickname      = '';
                $user->mobile_number = $contact->mobile_number;
                $user->work_number   = $contact->work_number;
                $user->home_number   = $contact->home_number;
                $user->email         = $contact->email;
                $user->username      = $request->input('contact_username');
                $user->password      = Hash::make($request->input('contact_password'));
                $user->is_active     = $request->input('is_active'); 
                $user->is_active     = 0;               
                $user->save();

                $contactUser = new ContactUser;
                $contactUser->contact_id = $contact_id;
                $contactUser->user_id = $user->id;
                $contactUser->save();

                //Send email notification
                $from_email   = 'noreply@corecms.com';
                $subject 	  = 'CoreCMS : Login Details';
                $recipients[$contact->email] = $contact->email;
                $login_url    = UserHelper::clientLoginURL();
                
                $message = "<p>Below are your login details : </p>";
                $message .= "<table><tr><td>Username</td><td>" . $request->input('contact_username') . "</td></tr><tr><td>Password</td><td>" . $request->input('contact_password') . "</td></tr><tr><td>Login URL</td><td>" . $login_url . "</td></tr></table><br /><p>Thank you</p>";

                Mail::to($recipients)
                        ->send(new MailContact($from_email, $subject, $message)); 

                Session::flash('message', 'You have successfully created an account');
                Session::flash('alert_class', 'alert-success');

            }else{
                Session::flash('message', 'Password does not match');
                Session::flash('alert_class', 'alert-danger');
            }
        }

        return redirect()->back();	
    }

    public function validateUsername($username)
    {
        $user = User::where('username', '=', $username)->first();
        if($user){
            return false;
        }else{
            return true;
        }
    }
}
