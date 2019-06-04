<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactController extends Controller
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
                Session::flash('message', 'You have no permission to access '. $module . ' the page.');
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
            $contact_query = Contact::query();

            if($search_by != '' && $search_field != '') {
            	if( $search_by == 'name' ){
            		$contact_query = $contact_query->where('contacts.firstname', 'like', '%' . $search_field . '%')->orWhere('contacts.lastname', 'like', '%' . $search_field . '%');
            	}else{
            		$contact_query = $contact_query->where('contacts.'.$search_by, 'like', '%' . $search_field . '%');
            	}
                
                $contact = $contact_query->paginate(15);
            }            
        } else {
            $contact = Contact::paginate(15);
        }

        return view('contact.index',[
        	'contact' => $contact,
            'search_field' => $search_field
        ]); 
    } 
}
