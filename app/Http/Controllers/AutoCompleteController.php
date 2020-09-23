<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Contact;

use UserHelper;
use GlobalHelper;

use DB;

use View;
use Hashids;

use Session;

class AutoCompleteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
        /*$this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'merchant_logs';
            $with_permission = UserHelper::checkUserRole($group_id, $module); 
            if(!$with_permission) {
                Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                Session::flash('alert_class', 'alert-danger');                
                return redirect('dashboard');
            }
        });   */              
    }

    public function ajax_search_contacts(Request $request)
    {
        $user_id  = Auth::user()->id;
        $search   = $request->input('q');
        $contact_query = Contact::query();
        $contact_query = $contact_query->leftJoin('contact_business_informations', 'contacts.id','=', 'contact_business_informations.contact_id');
        $contact_query = $contact_query->where('contact_business_informations.business_name', 'like', '%' . $search . '%')->get();
        
        $items    = array();
        foreach( $contact_query as $c ){
            $items[] = ['id' => Hashids::encode($c->id), 'text' => $c->business_name];
        }

        $json_data['results'] = $items;
        return response()->json($json_data);/*

        $user_id   = Auth::user()->id;
        $search    = $request->input('q');
        $companies = Contact::select('id','full_name')->where('full_name', 'like', '%' . $search . '%')->get();
        $items     = array();

        foreach( $companies as $c ){
            $items[] = ['id' => Hashids::encode($c->id), 'text' => $c->full_name];
        }

        $json_data['results'] = $items;
        return response()->json($json_data);*/
    }  
}
