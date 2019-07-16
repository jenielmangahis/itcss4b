<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Contact;
use App\ContactBusinessInformation;
use App\ContactBrokerInformation;
use App\ContactLoanInformation;
use App\Workflow;
use App\ContactEvent;
use App\CompanyUser;
use App\EventType;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactDashboardController extends Controller
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

    public function index($id, Request $request)
    {
    	$contact_id = $id;
        $id = Hashids::decode($id)[0];
        $contact = Contact::find($id); 
        $business_info = ContactBusinessInformation::where('contact_id','=', $id)->first();
        $contact_events = ContactEvent::all();

        if($contact) {
        	$workflow_status = Workflow::where('id', '=', $contact->status)->first();
        }

        $company_users = CompanyUser::where('company_id', '=', $contact->company_id)->get();
        $event_types   = EventType::all();

        return view('contact.dashboard.index',[
        	'contact_id' => $contact_id,
        	'contact' => $contact,
        	'business_info' => $business_info,
        	'workflow_status' => $workflow_status,
        	'contact_events' => $contact_events,
        	'company_users' => $company_users,
        	'event_types' => $event_types
        ]); 
    }     
}
