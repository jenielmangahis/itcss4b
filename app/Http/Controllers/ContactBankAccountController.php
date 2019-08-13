<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\ContactBankAccount;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactBankAccountController extends Controller
{
    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'routing_number'          => 'required',
                'account_number'      	 => 'required',
                'account_type'      => 'required',
                'name_on_account' => 'required',
                'bank_name' 		 => 'required',
                'address' 		 => 'required',
                'city' 		 => 'required',
                'state' 		 => 'required',
                'zip' => 'required'
             ]);

            $contact_id      = Hashids::decode($request->input('contact_id'))[0];            
            $bank_account_id = Hashids::decode($request->input('bank_account_id')); 
            $is_check_paying_client = 0;
            if( $request->input('is_check_paying_client') !== null ){
            	$is_check_paying_client = 1;
            }
            if( empty($bank_account_id) ){
            	$bankAccount  = new ContactBankAccount;
            	$bankAccount->contact_id = $contact_id;
            	$bankAccount->routing_number = $request->input('routing_number');
        		$bankAccount->account_number = $request->input('account_number');
        		$bankAccount->account_type = $request->input('account_type');
        		$bankAccount->name_on_account = $request->input('name_on_account');
        		$bankAccount->bank_name = $request->input('bank_name');
        		$bankAccount->address = $request->input('address');
        		$bankAccount->city = $request->input('city');
        		$bankAccount->zip = $request->input('zip');
        		$bankAccount->state = $request->input('state');
        		$bankAccount->is_check_paying_client = $is_check_paying_client;
        		$bankAccount->save();

        		Session::flash('message', 'You have successfully update bank account');
	            Session::flash('alert_class', 'alert-success');
            }else{
            	$bank_account_id = Hashids::decode($request->input('bank_account_id'))[0];
            	$bankAccount   	 = ContactBankAccount::find($bank_account_id);  
            	if( $bankAccount ){
            		$bankAccount->routing_number = $request->input('routing_number');
            		$bankAccount->account_number = $request->input('account_number');
            		$bankAccount->account_type = $request->input('account_type');
            		$bankAccount->name_on_account = $request->input('name_on_account');
            		$bankAccount->bank_name = $request->input('bank_name');
            		$bankAccount->address = $request->input('address');
            		$bankAccount->city = $request->input('city');
            		$bankAccount->zip = $request->input('zip');
            		$bankAccount->state = $request->input('state');
            		$bankAccount->is_check_paying_client = $is_check_paying_client;
            		$bankAccount->save();

            		Session::flash('message', 'You have successfully update bank account');
	            	Session::flash('alert_class', 'alert-success');
            	}else{
            		Session::flash('message', 'Unable to update bank account');
	            	Session::flash('alert_class', 'alert-danger');  
            	}  
            }

            return redirect()->back();	  
        }

    }
}
