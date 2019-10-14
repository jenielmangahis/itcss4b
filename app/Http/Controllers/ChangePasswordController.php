<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Group;

use App\Mail\MailContact;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class ChangePasswordController extends Controller
{
	public function __construct()
    {
    	//$this->middleware(['auth'], ['except' => ['reset_password', 'update_password']]);
    }

	public function reset_password(Request $request)
    {

        $reset_code = $request->input('reset_code');        
        $user       = User::where('reset_code', "=", $reset_code)->first();
        $is_code_valid = false;

        if($user && $reset_code != '') {           
            $is_code_valid = true;
        }else{
            Session::flash('message', 'Invalid reset code.');
            Session::flash('alert_class', 'alert-danger'); 
        }

        return view('change_password.reset_password', [
            'is_code_valid' => $is_code_valid,
            'user' => $user
        ]); 
    } 

    public function update_password(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $new_password = $request->input('password');
            $repassword   = $request->input('repassword');
            $id = $request->input('user_id');
            $id = Hashids::decode($id)[0];
            $u  = User::find($id);

            if($u) {
                if( $new_password == $repassword ){
                    $u->password   = Hash::make($new_password);
                    $u->reset_code = '';
                    $u->save();

                    Session::flash('message', 'Your password has been changed.');
                    Session::flash('alert_class', 'alert-success');

                     return redirect('login');
                }else{
                    Session::flash('message', 'Password does not match.');
                    Session::flash('alert_class', 'alert-danger');                  
                    return redirect()->back();     
                }                
            }else{
                Session::flash('message', 'User not found.');
                Session::flash('alert_class', 'alert-danger');                  
                return redirect()->back();  
            }
        }else{
            return redirect()->back();  
        }        
    }    
}
