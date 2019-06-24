<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\ContactCampaign;
use App\MediaType;
use App\Source;
use App\CompanyUser;

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

        if($search_by != '' && $search_field != '') {
            $contact_query = ContactCampaign::query();

            if($search_by != '' && $search_field != '') {

            	$contact_query = $contact_query->where('contact_campaigns.'.$search_by, 'like', '%' . $search_field . '%');
                
                $campaigns = $contact_query->paginate(15);

            }            
        } else {   
            $campaigns = ContactCampaign::paginate(15);          
        }

        $media_types    = MediaType::all();
        $sources        = Source::all();

        return view('contact.campaign.index',[
        	'campaigns' => $campaigns,
        	'search_field' => $search_field,
        	'media_types' => $media_types,
        	'sources' => $sources
        ]); 
    } 

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'title'            => 'required',      
                'campaign_cost'    => 'numeric',
                'purchase_amount'  => 'numeric',         
             ]);        

            $company_id   = 0;
            $user_id      = Auth::user()->id;
            $company_user = CompanyUser::where('user_id','=', $user_id)->first();
            if($company_user) {
                $company_id  = $company_user->company_id;
            }          

            $campaign = new ContactCampaign;  

	        $campaign->user_id          = $user_id;
	        $campaign->company_id       = $company_id;  
	        $campaign->title            = $request->input('title');
	        $campaign->status           = $request->input('status');
	        $campaign->start_date       = $request->input('start_date');
	        $campaign->end_date         = $request->input('end_date');
	        $campaign->source_id        = $request->input('source_id');
	        $campaign->media_type_id    = $request->input('media_type_id');
            $campaign->campaign_cost    = $request->input('campaign_cost');
            $campaign->purchase_amount  = $request->input('purchase_amount');
            $campaign->priority   		= $request->input('priority');
            $campaign->save();      
            
            if($campaign) {
                Session::flash('message', 'You have successfully add campaign');
                Session::flash('alert_class', 'alert-success');
                return redirect('contact_campaign');
            } else {
                Session::flash('message', 'Unable to add new campaign');
                Session::flash('alert_class', 'alert-danger');
                return redirect('contact_campaign');
            }

        }
    }   

    public function ajax_load_edit_fields(Request $request)
    {      
        $id               = Hashids::decode($request->input('id'))[0];
        $contact_campaign = ContactCampaign::where('id', '=', $id)->first();
        $media_types      = MediaType::all();
        $sources        = Source::all();
        return view('contact.campaign.ajax_load_edit_fields',[
        	'contact_campaign' => $contact_campaign,
        	'media_types' => $media_types,
        	'sources' => $sources
        ]);
    }  

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'title'            => 'required',      
                'campaign_cost'    => 'numeric',
                'purchase_amount'  => 'numeric',    
             ]);

            $id = Hashids::decode($request->input('id'))[0];
            $campaign = ContactCampaign::find($id);

            if($campaign) {

		        $campaign->title            = $request->input('title');
		        $campaign->status           = $request->input('status');
		        $campaign->start_date       = $request->input('start_date');
		        $campaign->end_date         = $request->input('end_date');
		        $campaign->source_id        = $request->input('source_id');
		        $campaign->media_type_id    = $request->input('media_type_id');
	            $campaign->campaign_cost    = $request->input('campaign_cost');
	            $campaign->purchase_amount  = $request->input('purchase_amount');
	            $campaign->priority   		= $request->input('priority');
	            $campaign->save();     

                Session::flash('message', 'Campaign has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('contact_campaign');
            }
        }

        Session::flash('message', 'Unable to update Campaign');
        Session::flash('alert_class', 'alert-danger');
        return redirect('contact_campaign');
    } 

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $c = ContactCampaign::find($id);

            if($c) {   
                $c->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('contact_campaign');
            }
        }
    }           
}
