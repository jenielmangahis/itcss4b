<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\ContactCreditCard;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactCreditCardController extends Controller
{
    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
            	'debit_credit' => 'required',
                'card_type' => 'required',
                'card_issuer' => 'required',
                'name_on_card' => 'required',
                'card_number' => 'required',
                'expiration_date_month' => 'required|numeric',
                'expiration_date_year' => 'required|numeric',
                'address' => 'required',
                'address2' => 'required',
                'city' => 'required',
                'state_id' => 'required',
                'zip' => 'required'
             ]);

            $contact_id      = Hashids::decode($request->input('contact_id'))[0];            
            $credit_card_id	 = Hashids::decode($request->input('contact_credit_card_id')); 
            
            if( empty($credit_card_id) ){
            	$credtCard  = new ContactCreditCard;
            	$credtCard->contact_id = $contact_id;
            	$credtCard->debit_credit = $request->input('debit_credit');
        		$credtCard->card_type = $request->input('card_type');
        		$credtCard->card_issuer = $request->input('card_issuer');
        		$credtCard->name_on_card = $request->input('name_on_card');
        		$credtCard->expiration_date_month = $request->input('expiration_date_month');
        		$credtCard->expiration_date_year = $request->input('expiration_date_year');
        		$credtCard->address = $request->input('address');
        		$credtCard->card_number = $request->input('card_number');
        		$credtCard->address2 = $request->input('address2');
        		$credtCard->city = $request->input('city');
        		$credtCard->zip = $request->input('zip');
        		$credtCard->state_id = $request->input('state_id');
        		$credtCard->save();

        		Session::flash('message', 'You have successfully update bank account');
	            Session::flash('alert_class', 'alert-success');
            }else{
            	$credit_card_id = Hashids::decode($request->input('contact_credit_card_id'))[0];
            	$credtCard   	 = ContactCreditCard::find($credit_card_id);  
            	if( $credtCard ){
            		$credtCard->debit_credit = $request->input('debit_credit');
	        		$credtCard->card_type = $request->input('card_type');
	        		$credtCard->card_issuer = $request->input('card_issuer');
	        		$credtCard->name_on_card = $request->input('name_on_card');
	        		$credtCard->card_number = $request->input('card_number');
	        		$credtCard->expiration_date_month = $request->input('expiration_date_month');
	        		$credtCard->expiration_date_year = $request->input('expiration_date_year');
	        		$credtCard->address = $request->input('address');
	        		$credtCard->address2 = $request->input('address2');
	        		$credtCard->city = $request->input('city');
	        		$credtCard->zip = $request->input('zip');
	        		$credtCard->state_id = $request->input('state_id');
            		$credtCard->save();

            		Session::flash('message', 'You have successfully update credit card');
	            	Session::flash('alert_class', 'alert-success');
            	}else{
            		Session::flash('message', 'Unable to update credit card');
	            	Session::flash('alert_class', 'alert-danger');  
            	}  
            }

            return redirect()->back();	  
        }
    }
}
