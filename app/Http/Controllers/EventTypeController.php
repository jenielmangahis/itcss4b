<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\EventType;
use App\ContactTask;
use App\ContactHistory;
use App\Contact;
use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class EventTypeController extends Controller
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
            $settled            = UserHelper::getContactsSettled();
            View::share ( 'settled', $settled );
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
            $event_type_query = EventType::query();

            if($search_by != '' && $search_field != '') {
                $event_type_query = $event_type_query->where('event_types.'.$search_by, 'like', '%' . $search_field . '%');
                $event_types = $event_type_query->paginate(15);
            }            
        } else {
            $event_types = EventType::paginate(15);
        }

        return view('event_type.index',[
        	'event_types' => $event_types,
            'search_field' => $search_field
        ]); 
    }

    public function create()
    {
        return view('event_type.create', [
            
        ]);
    } 
    
    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'           => 'required'      
             ]);

            $eventType                 = new EventType;
            $eventType->name           = $request->input('name');
            $eventType->save();

            Session::flash('message', 'You have successfully created new event type');
            Session::flash('alert_class', 'alert-success');
            return redirect('event_type');

        }else{
            Session::flash('message', 'Unable to create new event type');
            Session::flash('alert_class', 'alert-danger');  
            return redirect('event_type');
        }
    }   

    public function edit($id)
    {     
        $id = Hashids::decode($id)[0];
        $event_type   = EventType::where('id', '=', $id)->first();

        return view('event_type.edit', [
            'event_type' => $event_type
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
            $event_type = EventType::find($id);
            if($event_type) {
                $event_type->name = $request->input('name');
                $event_type->save();

                Session::flash('message', 'Event Type has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('event_type');
            }
        }

        Session::flash('message', 'Unable to update Event Type');
        Session::flash('alert_class', 'alert-danger');
        return redirect('event_type');
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $event_type = EventType::find($id);

            if($event_type) {   
                $event_type->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('event_type');
            }
        }
    }             
}
