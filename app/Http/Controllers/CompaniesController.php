<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Companies;
use App\ContactTask;
use App\ContactHistory;
use App\ContactBusinessInformation;
use App\Contact;
use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');       
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'companies';
            $with_permission = UserHelper::checkUserRole($group_id, $module); 
            if(!$with_permission) {
                Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                Session::flash('alert_class', 'alert-danger');                
                return redirect('dashboard');
            }    

            $pending_task_count = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->count();
            $pending_task       = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->get();

            $bankruptcy         = UserHelper::getCompaniesBankrupt();

            $idl_contacts = UserHelper::getIdleContacts();
            $idle_contacts_count = 0;
            $idle_contacts       = array();
            if(!empty($idl_contacts)) {
                $idle_contacts_count = $idl_contacts['total_idle'];
                $idle_contacts       = $idl_contacts['idle_data'];
            }

            $settled            = UserHelper::getContactsSettled();
            View::share ( 'settled', $settled );
            View::share ( 'idle_contacts_count', $idle_contacts_count );   
            View::share ( 'idle_contacts', $idle_contacts);             

            View::share ( 'pending_task_count', $pending_task_count );   
            View::share ( 'pending_task', $pending_task);     

            View::share ( 'bankruptcy', $bankruptcy );          

            return $next($request);     
        });              
    }

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            $companies_query = Companies::query();

            if($search_by != '' && $search_field != '') {
                $companies_query = $companies_query->where('companies.'.$search_by, 'like', '%' . $search_field . '%');
                $companies = $companies_query->paginate(15);
            }            
        } else {
            $companies = Companies::paginate(15);
        }

        return view('companies.index',[
        	'companies' => $companies,
            'search_field' => $search_field
        ]); 
    }  

    public function create()
    {
        return view('companies.create', [
        	
        ]);
    }  

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'           => 'required',
                'contact_number' => 'required'        
             ]);

            $comp                 = new Companies;
            $comp->name           = $request->input('name');
            $comp->contact_number = $request->input('contact_number');
            $comp->facebook   	  = $request->input('facebook');
            $comp->twitter  	  = $request->input('twitter');
            $comp->instagram  	  = $request->input('instagram');
            $comp->is_active      = $request->input('is_active');
            $comp->save();

            Session::flash('message', 'You have successfully created new companies');
            Session::flash('alert_class', 'alert-success');
            return redirect('companies');

        }else{
            Session::flash('message', 'Unable to create new companies');
            Session::flash('alert_class', 'alert-danger');
            return redirect('companies/create');        	
            return redirect('companies');
        }
    }   

    public function edit($id)
    {     
        $id = Hashids::decode($id)[0];
        $companies   = Companies::where('id', '=', $id)->first();

    	return view('companies.edit', [
    		'companies' => $companies
    	]);
    }  

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'           => 'required',
                'contact_number' => 'required'        
             ]);

            $id = Hashids::decode($request->input('id'))[0];
            $comp = Companies::find($id);
            if($comp) {
	            $comp->name           = $request->input('name');
	            $comp->contact_number = $request->input('contact_number');
	            $comp->facebook   	  = $request->input('facebook');
	            $comp->twitter  	  = $request->input('twitter');
	            $comp->instagram  	  = $request->input('instagram');
	            $comp->is_active      = $request->input('is_active');
                $comp->save();

                Session::flash('message', 'Company has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('companies');
            }
        }

        Session::flash('message', 'Unable to update company');
        Session::flash('alert_class', 'alert-danger');
        return redirect('companies');
    }         

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $c = Companies::find($id);

            if($c) {   
                $c->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('companies');
            }
        }
    }     
}
