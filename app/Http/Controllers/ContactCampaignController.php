<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\ContactCampaign;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactCampaignController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'contact_campaigns';
            $with_permission = UserHelper::checkUserRole($group_id, $module); 
            if(!$with_permission) {
                Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                Session::flash('alert_class', 'alert-danger');                
                return redirect('dashboard');
            }    

            return $next($request);     
        });                 
    }

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        $campaigns = ContactCampaign::all();

        return view('contact.campaign.index',[
        	'campaigns' => $campaigns,
        	'search_field' => $search_field
        ]); 
    }  
}
