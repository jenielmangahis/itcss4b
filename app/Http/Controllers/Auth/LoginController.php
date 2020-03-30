<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use UserLog;
use DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }   

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }  

    function authenticated(Request $request, $user) {

        DB::table('user_logs')->insert(
            array(
                'user_id'    => $user->id,
                'login_date' => Carbon::now()->toDateTimeString(),
                'created_at' => Carbon::now()->toDateTimeString()
            )
        );

        $user->last_login = Carbon::now()->toDateTimeString();
        $user->save();
    }        
}
