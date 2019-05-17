<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Companies;
use App\CompanyUser;
use App\Contact;
use App\ContactCustomField;
use App\EmailTemplate;
use App\Group;

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

        $ins = new Group;
        $ins->name    = 'this is only a test';
        $ins->save();

    }
}
