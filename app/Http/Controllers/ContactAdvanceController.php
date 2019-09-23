<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\ContactAdvance;
use App\ContactTask;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactAdvanceController extends Controller
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
                'advance_type'        => 'required',
                'payment_method'      => 'required',
                'advance_amount'      => 'required',
                'payment_period_type' => 'required'
             ]);         

            $loan_id    = GlobalHelper::generate_order_number(rand(0,9999));
            $contract_number = GlobalHelper::generate_order_number(rand(0,9999));
            $contact_id = Hashids::decode($request->input('contact_id'))[0];

            $contact_adv                  = new ContactAdvance;
            $contact_adv->contact_id      = $contact_id;
            $contact_adv->loan_id         = $loan_id;
            $contact_adv->contract_date   = $request->input('');
            $contact_adv->contract_number = $contract_number;
            //$contact_adv->advance_date    = $request->input('');
            $contact_adv->amount          = $request->input('advance_amount');
            $contact_adv->payback         = $request->input('payback_amount');
            $contact_adv->balance         = 0;
            $contact_adv->factor_rate     = $request->input('factor_rate');
            $contact_adv->remit           = $request->input('remit');
            $contact_adv->period          = $request->input('payment_period');
            $contact_adv->payment         = $request->input('payment');
            $contact_adv->advance_type    = $request->input('advance_type');
            $contact_adv->payment_method  = $request->input('payment_method');
            $contact_adv->status          = "Started"; //Paid in Full, Pricing, Started
            $contact_adv->save();            

            echo '<pre>';
            print_r($request->input());
            echo '</pre>';

            Session::flash('message', 'You have successfully created new advances');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();             
		} else {
            Session::flash('message', 'Unable to create new advances');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();			
		}

    } 

}
