<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\ContactTask;

use App\Lender;
use App\LenderContact;
use App\ContactAdvance;
use App\ContactHistory;

use UserHelper;
use GlobalHelper;

use DB;

use View;
use Hash;
use Hashids;

use Session;

class LenderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'lenders';
            $with_permission = UserHelper::checkUserRole($group_id, $module); 
            if(!$with_permission) {
                Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                Session::flash('alert_class', 'alert-danger');                
                return redirect('dashboard');
            }    

            $pending_task_count = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->count();
            $pending_task       = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->get();

            $idl_contacts = UserHelper::getIdleContacts();
            $idle_contacts_count = 0;
            $idle_contacts       = array();
            if(!empty($idl_contacts)) {
                $idle_contacts_count = $idl_contacts['total_idle'];
                $idle_contacts       = $idl_contacts['idle_data'];
            }

            View::share ( 'idle_contacts_count', $idle_contacts_count );   
            View::share ( 'idle_contacts', $idle_contacts);             

            View::share ( 'pending_task_count', $pending_task_count );   
            View::share ( 'pending_task', $pending_task);             

            return $next($request);     
        });                 
    }

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        /*
         * Lenders
        */ 
        if($search_by != '' && $search_field != '') {
            $lender_query = Lender::query();
            if($search_by != '' && $search_field != '') {
                $lender_query = $lender_query->where('lenders.'.$search_by, 'like', '%' . $search_field . '%');
                $lenders = $lender_query->paginate(10);
            }            
        } else {
            $lenders = Lender::paginate(10);
        }
        /*
         * Lenders - end
        */        

        return view('lender.index',[
            'search_field' => $search_field,
            'lenders' => $lenders
        ]); 
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'company_name' => 'required',
                'street'   => 'required',
                'zip_code' => 'required',
                'email'    => 'required'
             ]);

            $lender                 = new Lender;
            $lender->company_name   = $request->input('company_name');
            $lender->street         = $request->input('street');
            $lender->city           = $request->input('city');
            $lender->state          = $request->input('state');
            $lender->zip_code       = $request->input('zip_code');
            $lender->phone          = $request->input('phone');
            $lender->email          = $request->input('email');
            $lender->url_site       = $request->input('url_site');
            $lender->notes          = $request->input('notes');
            $lender->save();

            Session::flash('message', 'You have successfully created new lender');
            Session::flash('alert_class', 'alert-success');
            return redirect('lender');

        }else{
            Session::flash('message', 'Unable to create new lender');
            Session::flash('alert_class', 'alert-danger');  
            return redirect('lender');
        }
    }  

    
    public function store_lender_contact(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'    => 'required',
                'email'   => 'required',

             ]);

            $contact_lender         = new LenderContact;
            $contact_lender->name   = $request->input('name');
            $contact_lender->email  = $request->input('email');
            $contact_lender->save();

            Session::flash('message', 'You have successfully created new Contact lender');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();

        }else{
            Session::flash('message', 'Unable to create Contact lender');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();
        }
    }      

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'company_name' => 'required',
                'street'   => 'required',
                'zip_code' => 'required',
                'email'    => 'required'
             ]);

        }

        $id = Hashids::decode($request->input('id'))[0];
        $lender = Lender::find($id); 

        if($lender) {        

            $lender->company_name   = $request->input('company_name');
            $lender->street         = $request->input('street');
            $lender->city           = $request->input('city');
            $lender->state          = $request->input('state');
            $lender->zip_code       = $request->input('zip_code');
            $lender->phone          = $request->input('phone');
            $lender->email          = $request->input('email');
            $lender->url_site       = $request->input('url_site');
            $lender->notes          = $request->input('notes');
            $lender->save();

            Session::flash('message', 'You have successfully updated lender');
            Session::flash('alert_class', 'alert-success');
            return redirect('lender');            

        }

        Session::flash('message', 'Unable to update lender');
        Session::flash('alert_class', 'alert-danger');  
        return redirect('lender');        
    }     

    public function view($id)
    {
        $advances_count         = 0; 
        $advances_total_amount  = 0;
        $advances_total_payback = 0;

        $id = Hashids::decode($id)[0];
        $lender = Lender::find($id); 
        $lender_contacts = LenderContact::all();

        if($lender) {
            $advances = ContactAdvance::where('lender_id','=', $lender->id)->paginate(10);
            $advances_count = ContactAdvance::where('lender_id','=', $lender->id)->count();
            $advances_total_amount  = ContactAdvance::where('lender_id','=', $lender->id)->sum('amount');
            $advances_total_payback = ContactAdvance::where('lender_id','=', $lender->id)->sum('payback');

	        return view('lender.view',[
	            'lender' => $lender,
	            'lender_contacts' => $lender_contacts,
                'advances' => $advances,
                'advances_count' => $advances_count,
                'advances_total_amount' => $advances_total_amount,
                'advances_total_payback' => $advances_total_payback
	        ]); 

        } else {
	        Session::flash('message', 'Unable to get lender');
	        Session::flash('alert_class', 'alert-danger');  
	        return redirect('lender');          	
        }   
              	
    }    

    public function ajax_load_pie_chart_data(Request $request)
    {    
        $lender_funded_amount   = 0;
        $funded_percentage      = 0;
        $all_lender_funded_total_amount = 0;

        $pie_data   = array();
        $pie_colors = array('#f56954','#00a65a','#f39c12','#00c0ef','#3c8dbc','#d2d6de'); 

        $lenders = Lender::all(); 
        $all_lender_funded_total_amount  = ContactAdvance::where('amount','>', 0)->where('lender_id','!=',0)->sum('amount');
        if(!$lenders->isEmpty()) {
            foreach($lenders as $lender) {
                $pie_color_id = array_rand($pie_colors);

                $lender_funded_amount = ContactAdvance::where('lender_id','=', $lender->id)->sum('amount');

                $funded_percentage = ($lender_funded_amount / $all_lender_funded_total_amount) * 100;

                $pie_data[$lender->id]['value']     = number_format($funded_percentage,2);
                $pie_data[$lender->id]['color']     = $pie_colors[$pie_color_id];
                $pie_data[$lender->id]['highlight'] = $pie_colors[$pie_color_id];
                $pie_data[$lender->id]['label']     = $lender->company_name;
            }
        } else {
            $pie_data[1]['value'] = 1;
            $pie_data[1]['color'] = '#00a65a';
            $pie_data[1]['highlight'] = '#00a65a';
            $pie_data[1]['label'] = 'No Lender Recors!';  
        }

        return json_encode($pie_data);      
    }

    public function ajax_load_area_chart_data(Request $request)
    {
        $area_data = array();
        $area_dumb_data = array();

        $advances_records = ContactAdvance::select('amount','created_at', DB::raw('MONTH(created_at) month') )
                                ->where('amount','>',0)->where('lender_id','!=',0)->get();                      

        if(!$advances_records->isEmpty()) {
            foreach($advances_records->toArray() as $adv_rec) {
                $area_dumb_data[$adv_rec['month']][] = $adv_rec;
            }
        }

        $date_array = array(
                            1 => 'Jan',
                            2 => 'Feb',
                            3 => 'Mar',
                            4 => 'Apr',
                            5 => 'May',
                            6 => 'Jun',
                            7 => 'Jul',
                            8 => 'Aug',
                            9 => 'Sept',
                            10 => 'Oct',
                            11 => 'Nov',
                            12 => 'Dec',
                        );

        foreach($area_dumb_data as $add_key => $add) {
            $area_data['months'][] = $date_array[$add_key];

            $total_adv_amount = 0;
            foreach($add as $ad) {
                $total_adv_amount += $ad['amount'];
                $area_data['amounts'][$add_key] = $total_adv_amount;
            }
        }

        /*$area_data['months'] = array('January', 'February', 'March');
        $area_data['amounts'] = array(3600, 15000, 6500);*/

        return json_encode($area_data);    
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $lender = Lender::find($id);

            if($lender) {   
                $lender->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('lender');
            }
        }
    }   

    public function lender_contact_destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('lender_contact_id');
            $id = Hashids::decode($id)[0];
            $lender_contact = LenderContact::find($id);

            if($lender_contact) {   
                $lender_contact->delete();
                Session::flash('message', "Delete Lender Contact Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();
            }
        }
    }     
}
