<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Group;
use App\ContactTask;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');       
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'users';
            $with_permission = UserHelper::checkUserRole($group_id, $module); 
            if(!$with_permission) {
                Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                Session::flash('alert_class', 'alert-danger');                
                return redirect('dashboard');
            } 

            $pending_task_count = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->count();
            $pending_task       = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->get();

            View::share ( 'pending_task_count', $pending_task_count );   
            View::share ( 'pending_task', $pending_task);                  

            return $next($request);     
        });           
    }

    public function index(Request $request)
    {
        $group_id     = Auth::user()->group_id;
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            $users_query = User::query();
            $users_query = $users_query->where('is_active', '=', 0);

            if(UserHelper::isCompanyUser($group_id)) {
                $users_query = $users_query->where('group_id', '=', $group_id);
            }            

            if($search_by != '' && $search_field != '') {
                $users_query = $users_query->where('users.'.$search_by, 'like', '%' . $search_field . '%');
                $users = $users_query->paginate(15);
            }            
        } else {
            $users_query = User::query();
            $users_query = $users_query->where('is_active', '=', 0);
            if(UserHelper::isCompanyUser($group_id)) {
                $users_query = $users_query->where('group_id', '=', $group_id);
            }
            $users = $users_query->paginate(15);
        }

        return view('user.index',[
        	'users' => $users,
            'search_field' => $search_field
        ]); 
    }   

    public function profile() 
    {
        $id     = Auth::id();
        $user   = User::where('id', '=', $id)->first();

        return view('user.profile',['user' => $user]);         
    }    

    public function updateProfile(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = Hashids::decode($request->input('id'))[0];
            $user = User::find($id);

            if($user) {

                if($request->file()) {
                    $image = $request->file('profile_image');
                    $input['imagename'] = md5(date("Y-m-d") . "-" . rand()) . '.' . $image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/users');
                    $image->move($destinationPath, $input['imagename']);
                    $profile_image_name = $input['imagename'];  
                } else {
                    $profile_image_name = 'no-image.png';
                }

                $user->firstname     = $request->input('firstname');
                $user->lastname      = $request->input('lastname');
                $user->mobile_number = $request->input('mobile_number');
                $user->nickname      = $request->input('nickname');
                $user->profile_img = $profile_image_name;      

                if($request->input('password') != '' && $request->input('confirm_password') != '') {
                    if($request->input('password') == $request->input('confirm_password')) {
                        $user->password   = Hash::make($request->input('password'));    
                    } else {
                        Session::flash('message', 'Password does not match');
                        Session::flash('alert_class', 'alert-danger');
                        return redirect('user/profile');                        
                    }
                }

                $user->save();

                Session::flash('message', 'Your profile has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('user/profile');
            }
        }

        Session::flash('message', 'Unable to update your profile');
        Session::flash('alert_class', 'alert-danger');
        return redirect('profile');
    }     

    public function create()
    {
        $groups = Group::all();
        return view('user.create', [
        	'groups' => $groups
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
             ]);

            if(!$this->validateEmail($request->input('email'))) {
                Session::flash('message', 'Email already exist.');
                Session::flash('alert_class', 'alert-danger');
                return redirect('user/create');
            }

            if(!$this->validateUsername($request->input('username'))) {
                Session::flash('message', 'Username already exist.');
                Session::flash('alert_class', 'alert-danger');
                return redirect('user/create');
            }

            if($request->input('password') == $request->input('confirm_password')) {
                $user = new User;
                $user->group_id   	 = $request->input('group_id');
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

                Session::flash('message', 'You have successfully created an account');
                Session::flash('alert_class', 'alert-success');
                return redirect('users');

            }else{
                Session::flash('message', 'Password does not match');
                Session::flash('alert_class', 'alert-danger');
                return redirect('user/create');
            }
        }else{
            return redirect('users');
        }
    }    

    public function edit($id)
    {     
        $id     = Hashids::decode($id)[0];
        $user   = User::where('id', '=', $id)->first();
        $groups = Group::all();

    	return view('user.edit', [
    		'user' => $user,
            'groups' => $groups
    	]);
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
                $user->group_id      = $request->input('group_id');
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
                        return redirect('user/edit/' . Hashids::encode($request->input('id')));                        
                    }
                }

                $user->save();

                Session::flash('message', 'User has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('users');
            }
        }

        Session::flash('message', 'Unable to update user');
        Session::flash('alert_class', 'alert-danger');
        return redirect('users');
    }    

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $u = User::find($id);

            if($u) {   
                $u->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('users');
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

    public function activate(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('user_id');
            $id = Hashids::decode($id)[0];
            $u = User::find($id);

            if($u) {   
                $u->is_active = 0;
                $u->save();
                Session::flash('message', "Update Successful");
                Session::flash('alert_class', 'alert-success');
            }
        }

        return redirect()->back();  
    }  

    public function deactivate(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('user_id');
            $id = Hashids::decode($id)[0];
            $u = User::find($id);

            if($u) {   
                $u->is_active = 1;
                $u->save();
                Session::flash('message', "Update Successful");
                Session::flash('alert_class', 'alert-success');
            }
        }

        return redirect()->back();  
    }     

}
