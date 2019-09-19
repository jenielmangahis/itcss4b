<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\ContactTask;

use App\Lender;
use App\LenderContact;

use UserHelper;
use GlobalHelper;

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
            Session::flash('message', 'Unable to create new event type');
            Session::flash('alert_class', 'alert-danger');  
            return redirect('lender');
        }
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
}
