<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Companies;
use App\CompanyUser;
use App\User;
use App\ContactTask;
use App\ContactHistory;
use App\ContactBusinessInformation;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class CompanyUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');      
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'company_users';
            $with_permission = UserHelper::checkUserRole($group_id, $module); 
            if(!$with_permission) {
                $module = 'MCA Funders';
                Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                Session::flash('alert_class', 'alert-danger');                
                return redirect('dashboard');
            }    

            $pending_task_count = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->count();
            $pending_task       = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->get();

            $bankruptcy_count   = ContactBusinessInformation::where('filed_bankruptcy','=','Yes')->where('bankruptcy_filed','<=',now()->subMonth(2))->count();

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

            View::share ( 'bankruptcy_count', $bankruptcy_count );              

            return $next($request);     
        });           
    }

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            /*$users_query = User::query();
            $users_query = $users_query->where('is_active', '=', 0);

            if($search_by != '' && $search_field != '') {
                $users_query = $users_query->where('users.'.$search_by, 'like', '%' . $search_field . '%');
                $users = $users_query->paginate(15);
            }*/            
        } else {
            $company_users = CompanyUser::paginate(15);
        }

        $company_users = CompanyUser::paginate(15);

        return view('company_user.index',[
        	'company_users' => $company_users,
            'search_field' => $search_field
        ]); 
    }   

    public function create()
    {
    	$companies = Companies::where('is_active','=',0)->get();
        return view('company_user.create', [
        	'companies' => $companies
        ]);
    }     

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'firstname'        => 'required',
                'lastname'         => 'required',
                'email'            => 'required|email',
                'password'         => 'min:6|required_with:confirm_password|same:confirm_password',
                'mobile_number'    => 'required',       
                'company_id'       => 'required',       
             ]);

            if(!$this->validateEmail($request->input('email'))) {
                Session::flash('message', 'Email already exist.');
                Session::flash('alert_class', 'alert-danger');
                return redirect('company_users/create');
            }

            if(!$this->validateUsername($request->input('username'))) {
                Session::flash('message', 'Username already exist.');
                Session::flash('alert_class', 'alert-danger');
                return redirect('company_users/create');
            }

            if($request->input('password') == $request->input('confirm_password')) {
                $user = new User;
                $user->group_id   	 = 2;
                $user->firstname     = ucfirst($request->input('firstname'));
                $user->lastname      = ucfirst($request->input('lastname'));
                $user->nickname      = $request->input('nickname');
                $user->mobile_number = $request->input('mobile_number');
                $user->work_number   = $request->input('work_number');
                $user->home_number   = $request->input('home_number');
                $user->email         = $request->input('email');
                $user->username      = $request->input('username');
                $user->password      = Hash::make($request->input('password'));
                $user->is_active     = $request->input('is_active');
                $user->save();

                if($user) {
                	$company_user = new CompanyUser; 
                	$company_user->company_id  = $request->input('company_id');
                	$company_user->user_id     = $user->id;
                	$company_user->save();

	                Session::flash('message', 'You have successfully created an account');
	                Session::flash('alert_class', 'alert-success');
	                return redirect('company_users');                	
                }

            }else{
                Session::flash('message', 'Password does not match');
                Session::flash('alert_class', 'alert-danger');
                return redirect('company_users/create');
            }
        }else{
            return redirect('company_users');
        }
    }    

    public function edit($id)
    {     
        $id = Hashids::decode($id)[0];

        $company_user = CompanyUser::find($id);
        if($company_user) {

        	$user   = User::where('id', '=', $company_user->user_id)->first();
        	if($user) {
        		$companies = Companies::where('is_active','=',0)->get();
		    	return view('company_user.edit', [
		    		'user' 			=> $user,
		    		'company_user' 	=> $company_user,
		    		'companies' 	=> $companies,
		    	]);

        	} else {
        		return redirect('company_users');
        	}
        }   

    }

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'firstname'        => 'required',
                'lastname'         => 'required',
                'mobile_number'    => 'required',              
             ]);

            $id = Hashids::decode($request->input('id'))[0];
            $user = User::find($id);
            if($user) {
                $user->firstname     = $request->input('firstname');
                $user->lastname      = $request->input('lastname');
                $user->nickname      = $request->input('nickname');
                $user->mobile_number = $request->input('mobile_number');
                $user->work_number   = $request->input('work_number');
                $user->home_number   = $request->input('home_number');   
                $user->is_active     = $request->input('is_active');  

                if($request->input('password') != '' && $request->input('confirm_password') != '') {
                    if($request->input('password') == $request->input('confirm_password')) {
                        $user->password   = Hash::make($request->input('password'));    
                    } else {
                        Session::flash('message', 'Password does not match');
                        Session::flash('alert_class', 'alert-danger');
                        return redirect('company_users/edit/' . Hashids::encode($request->input('id')));                        
                    }
                }

                $user->save();

                $company_user_id = Hashids::decode($request->input('company_user_id'))[0]; 
                $company_user    = CompanyUser::find($company_user_id);
                if($company_user) {
                	$company_user->company_id = $request->input('company_id');
                	$company_user->save();
                }

                Session::flash('message', 'User has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('company_users');
            }
        }

        Session::flash('message', 'Unable to update user');
        Session::flash('alert_class', 'alert-danger');
        return redirect('company_users');
    }    

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $u = CompanyUser::find($id);

            if($u) {   
                $u->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('company_users');
            }
        }
    } 

    public function validateUsername($username)
    {
        $user = User::where('username', '=', $username)->first();
        if($user){
            return false;
        }else{
            return true;
        }
    }      

    public function validateEmail($email)
    {
        $user = User::where('email', '=', $email)->first();
        if($user){
            return false;
        }else{
            return true;
        }
    }
}
