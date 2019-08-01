<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\ContactCallTracker;

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

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'call_type'          => 'required',
                'call_result'      	 => 'required',
                'event_type_id'      => 'required',
                'call_update_status' => 'required',
                'call_minutes' 		 => 'required|numeric',
                'call_seconds' 		 => 'required|numeric',
             ]);

            $user_id      = Auth::user()->id;

            $call_tracker              	= new ContactCallTracker;
            $call_tracker->user_id     	= $user_id;
            $call_tracker->contact_id  	= $request->input('contact_id');
            $call_tracker->call_type    = $request->input('call_type');
            $call_tracker->call_result  = $request->input('call_result');
            $call_tracker->call_minutes = $request->input('call_minutes');
            $call_tracker->call_seconds = $request->input('call_seconds');
            $call_tracker->notes        = $request->input('notes');
            $call_tracker->event_type_id = $request->input('event_type_id');   
            $call_tracker->call_update_status = $request->input('call_update_status');
            $call_tracker->save();

            Session::flash('calltrackermodal', 'yes');
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


}
