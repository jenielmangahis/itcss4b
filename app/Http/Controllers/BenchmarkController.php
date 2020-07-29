<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Companies;
use App\CompanyUser;
use App\Contact;
use App\ContactCustomField;
use App\EmailTemplate;
use App\Group;
use App\ContactBusinessInformation;

/*
 * Note: below 'MailNotification' class is located in 'app/Mail' folder
*/
use App\Mail\MailNotification;
use App\Mail\ContactNoteNotification;

use Session;
use Route;

class BenchmarkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lte_fixed(Request $request)
    {
        return view('lte.lte_fixed',[
        ]); 
    }

    public function testModel()
    {
    	echo 'Test Model Here <hr />';

        $bankruptcy         = ContactBusinessInformation::where('filed_bankruptcy','=','Yes')->where('bankruptcy_filed','<=',now()->subMonth(2))->get();

        foreach($bankruptcy as $bankrup) {
            
            if(isset($bankrup->contact->status)) {
                echo 'Contact Status: ' . $bankrup->contact->status;
                echo '<br />';
            }

            echo $bankrup->business_name;
            echo '<hr />';
        }

        echo '<pre>';
        print_r($bankruptcy->toArray());
        echo '</pre>';        

        /*$ins = new Companies;
        $ins->name   		 = 'bryann';
        $ins->contact_number = '0929986589';
        $ins->facebook  	 = 'testing';
        $ins->twitter   	 = 'testing';
        $ins->instagram   	 = 'testing';
        $ins->is_active   	 = 1;
        $ins->save();*/    	

        /*$ins = new CompanyUser;
        $ins->company_id   	 = 2;
        $ins->user_id   	 = 1;
        $ins->save();*/

        /*$ins = new Contact;
        $ins->company_id   	 = 2;
        $ins->user_id   	 = 1;
        $ins->firstname   	 = 'test';
        $ins->lastname   	 = 'last';;
        $ins->email   	 	 = 'test@test.com';
        $ins->save();*/

        /*$ins = new ContactCustomField;
        $ins->contact_id   	 = 2;
        $ins->name   	     = 'test';
        $ins->value   	     = 'this is only a test';
        $ins->save();*/

        /*$ins = new EmailTemplate;
        $ins->company_id = 2;
        $ins->user_id    = 33;
        $ins->name   	 = 'test name';
        $ins->content    = 'this is only a test';
        $ins->save();*/

        /*$ins = new Group;
        $ins->name    = 'this is only a test';
        $ins->save();*/

    }

    function testMail() {
        echo '<h3>THIS IS A TEST EMAIL</h3><hr />';

        /*
            NOTE :
                - This uses laravel mailable, please check references below
                    - https://laravel.com/docs/5.8/mail
                    - https://www.tutsmake.com/send-email-in-laravel-mailable-example/
                - make sure you setup your smtp on your .env file in root folder, please check screenshot: http://prntscr.com/ogq794
                    - I use mailtrap to test it on your local pc : https://mailtrap.io
                - make sure to clear cache after you setup the correct smtp on .env file
                - to clear cache in laravel, run this code on your laravel root file
                    - php artisan config:cache
                    - php artisan config:clear
                    - php artisan cache:clear
        */

        $enable_email = true;
        if($enable_email) {

            $name    = 'Bryann Revina';
            $email   = 'bryann.revina@gmail.com';
            $from_email = 'admin@coreCRM.coms';
            $subject = 'Contact Note Notification';
            $message = 'This is to notify you that ' . $name . ' add a new note.';

            /*Mail::to('jeniel.mangahis@gmail.com')
                ->send(new MailNotification($name, $email, $subject, $message)); */

            Mail::to('jeniel.mangahis@gmail.com')
                ->send(new ContactNoteNotification($name, $email, $from_email, $subject, $message)); 

            // 'MailNotification' class is located on app/Mail folder

            /*Mail::to($request->user())
                ->cc($moreUsers)
                ->bcc($evenMoreUsers)
                ->later($when, new OrderShipped($order));*/                    


        }
    }
}
