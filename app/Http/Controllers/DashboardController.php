<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;
use Route;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'dashboard';
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
    	
        return view('dashboard.index',[
        ]); 
    }
}