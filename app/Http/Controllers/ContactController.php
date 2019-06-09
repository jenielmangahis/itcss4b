<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Contact;
use App\CompanyUser;
use App\Companies;
use App\Stage;

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
            $contact_query = Contact::query();

            if($search_by != '' && $search_field != '') {

            	if( $search_by == 'name' ){
            		$contact_query = $contact_query->where('contacts.firstname', 'like', '%' . $search_field . '%')->orWhere('contacts.lastname', 'like', '%' . $search_field . '%');
                    if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                        $contact_query = $contact_query->where('user_id', '=', Auth::user()->id);
                    }            	       
                }else{
            		$contact_query = $contact_query->where('contacts.'.$search_by, 'like', '%' . $search_field . '%');
            	    if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                        $contact_query = $contact_query->where('user_id', '=', Auth::user()->id);
                    }
                }
                
                $contact = $contact_query->paginate(15);
            }            
        } else {
            
            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $user_id = Auth::user()->id;
                $contact = Contact::where('user_id','=', $user_id)
                            ->paginate(15); 
            }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                $contact = Contact::paginate(15);  
            }            
        }

        return view('contact.index',[
        	'contact' => $contact,
            'search_field' => $search_field
        ]); 
    } 

    public function create()
    {
        $stages    = Stage::all();
        $companies = Companies::all();

        if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
            return view('contact.c_create', [
                'stages' => $stages
            ]);   
        }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
            return view('contact.create', [
                'stages' => $stages,
                'companies' => $companies
            ]);   
        } 
    }      

    
    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $this->validate($request, [
                    'firstname'        => 'required',
                    'lastname'         => 'required',
                    'email'            => 'required|email',
                    'mobile_number'    => 'required',  
                    'address1'         => 'required',   
                    'zip_code'         => 'required',          
                 ]);
            } else {
                $this->validate($request, [
                    'firstname'        => 'required',
                    'lastname'         => 'required',
                    'email'            => 'required|email',
                    'mobile_number'    => 'required',  
                    'address1'         => 'required',   
                    'zip_code'         => 'required',  
                    'company_id'       => 'required',
                    'user_id'          => 'required'           
                 ]);                
            }

            $company_id   = 0;
            $user_id      = Auth::user()->id;
            $company_user = CompanyUser::where('user_id','=', $user_id)->first();
            if($company_user) {
                $company_id  = $company_user->company_id;
            }

            $contact = new Contact;

            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $contact->user_id       = $user_id;
                $contact->company_id    = $company_id;  
            }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
                $contact->user_id       = $request->input('user_id');
                $contact->company_id    = $request->input('company_id');
            } 

            $contact->stage_id      = $request->input('stage_id');
            $contact->full_name     = ucfirst($request->input('firstname')) . ' ' . ucfirst($request->input('lastname'));
            $contact->firstname     = ucfirst($request->input('firstname'));
            $contact->lastname      = ucfirst($request->input('lastname'));
            $contact->email         = $request->input('email');
            $contact->mobile_number = $request->input('mobile_number');
            $contact->work_number   = $request->input('work_number');
            $contact->home_number   = $request->input('home_number');
            $contact->address1      = $request->input('address1');
            $contact->address2      = $request->input('address2');
            $contact->city          = $request->input('city');
            $contact->state         = $request->input('state');
            $contact->zip_code      = $request->input('zip_code');
            $contact->status        = $request->input('status');
            $contact->save();

            if($contact) {
                Session::flash('message', 'You have successfully add contact');
                Session::flash('alert_class', 'alert-success');
                return redirect('contact');
            } else {
                Session::flash('message', 'Unable to add new contact');
                Session::flash('alert_class', 'alert-danger');
                return redirect('contact');
            }

        }else{
            Session::flash('message', 'Unable to add new contact');
            Session::flash('alert_class', 'alert-danger');           
            return redirect()->back();
        }
    }     

    public function edit($id)
    {     
        $id        = Hashids::decode($id)[0];
        $stages    = Stage::all();
        $companies = Companies::all();
        if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
            $contact = Contact::where('id', '=', $id)->first();
            return view('contact.c_edit', [
                'contact' => $contact,
                'stages'  => $stages,
                'companies' => $companies
            ]);   
        }elseif(UserHelper::isAdminUser(Auth::user()->group_id)) {
            $contact = Contact::where('id', '=', $id)->first();
            return view('contact.edit', [
                'contact' => $contact,
                'stages' => $stages,
                'companies' => $companies
            ]);   
        }
    }    

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            if(UserHelper::isCompanyUser(Auth::user()->group_id)) {
                $this->validate($request, [
                    'firstname'        => 'required',
                    'lastname'         => 'required',
                    'email'            => 'required|email',
                    'mobile_number'    => 'required',  
                    'address1'         => 'required',   
                    'zip_code'         => 'required',          
                 ]);
            } else {
                $this->validate($request, [
                    'firstname'        => 'required',
                    'lastname'         => 'required',
                    'email'            => 'required|email',
                    'mobile_number'    => 'required',  
                    'address1'         => 'required',   
                    'zip_code'         => 'required',  
                    'company_id'       => 'required',
                    'user_id'          => 'required'           
                 ]);                
            }

            $id = Hashids::decode($request->input('id'))[0];
            $contact = Contact::find($id); 

            if($contact) {

                if(UserHelper::isAdminUser(Auth::user()->group_id)) {
                    $contact->user_id       = $request->input('user_id');
                    $contact->company_id    = $request->input('company_id');
                } 

                $contact->stage_id      = $request->input('stage_id');
                $contact->full_name     = ucfirst($request->input('firstname')) . ' ' . ucfirst($request->input('lastname'));
                $contact->firstname     = ucfirst($request->input('firstname'));
                $contact->lastname      = ucfirst($request->input('lastname'));
                $contact->email         = $request->input('email');
                $contact->mobile_number = $request->input('mobile_number');
                $contact->work_number   = $request->input('work_number');
                $contact->home_number   = $request->input('home_number');
                $contact->address1      = $request->input('address1');
                $contact->address2      = $request->input('address2');
                $contact->city          = $request->input('city');
                $contact->state         = $request->input('state');
                $contact->zip_code      = $request->input('zip_code');
                $contact->status        = $request->input('status');
                $contact->save();

                Session::flash('message', 'Contact has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('contact');                
            } 

        }

        Session::flash('message', 'Unable to update contact');
        Session::flash('alert_class', 'alert-danger');
        return redirect('contact');        
    }      

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $c = Contact::find($id);

            if($c) {   
                $c->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('contact');
            }
        }
    }    

    public function ajax_load_company_users(Request $request)
    {
        $company_users = CompanyUser::where('company_id', '=', $request->input('company_id'))->get();
        $c_user_id = $request->input('c_user_id');
        return view('contact.ajax_load_company_users_dropdown',[
            'company_users' => $company_users,
            'c_user_id'     => $c_user_id
        ]);
    } 
}
