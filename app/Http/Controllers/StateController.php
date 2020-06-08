<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\State;
use App\ContactTask;
use App\ContactHistory;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class StateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');       
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'settings';
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

            View::share ( 'idle_contacts_count', $idle_contacts_count );   
            View::share ( 'idle_contacts', $idle_contacts);             

            View::share ( 'pending_task_count', $pending_task_count );   
            View::share ( 'pending_task', $pending_task);                

            View::share ( 'bankruptcy', $bankruptcy);                

            return $next($request);     
        });           
    }

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            $state_query = State::query();

            if($search_by != '' && $search_field != '') {
                $state_query = $state_query->where('states.'.$search_by, 'like', '%' . $search_field . '%');
                $states = $state_query->paginate(15);
            }            
        } else {
            $states = State::paginate(15);
        }

        return view('state.index',[
        	'states' => $states,
            'search_field' => $search_field
        ]); 
    }

    public function create()
    {
        return view('state.create', [
            
        ]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'           => 'required'      
             ]);

            $state                 = new State;
            $state->name           = $request->input('name');
            $state->save();

            Session::flash('message', 'You have successfully created new state');
            Session::flash('alert_class', 'alert-success');
            return redirect('state');

        }else{
            Session::flash('message', 'Unable to create new state');
            Session::flash('alert_class', 'alert-danger');  
            return redirect('state');
        }
    }

    public function edit($id)
    {     
        $id = Hashids::decode($id)[0];
        $state   = State::where('id', '=', $id)->first();

        return view('state.edit', [
            'state' => $state
        ]);
    }

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'           => 'required'       
             ]);

            $id = Hashids::decode($request->input('id'))[0];
            $state = State::find($id);
            if($state) {
                $state->name = $request->input('name');
                $state->save();

                Session::flash('message', 'State has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('state');
            }
        }

        Session::flash('message', 'Unable to update State');
        Session::flash('alert_class', 'alert-danger');
        return redirect('state');
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $state = State::find($id);

            if($state) {   
                $state->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('state');
            }
        }
    }
}
