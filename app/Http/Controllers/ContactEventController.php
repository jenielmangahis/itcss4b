<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\ContactEvent;
use App\EventType;
use App\ContactTask;
use App\ContactHistory;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactEventController extends Controller
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

            $pending_task_count = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->count();
            $pending_task       = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->get();

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

            return $next($request);     
        });                 
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'title'           => 'required',
                'event_date'      => 'required',
                'location'        => 'required',
                'description'     => 'required',
             ]);

            $contact_id = Hashids::decode($request->input('contact_id'))[0];

            $contact_event              = new ContactEvent;
            $contact_event->title       = $request->input('title');
            $contact_event->event_date  = $request->input('event_date');
            $contact_event->event_time  = date( "H:i:s",strtotime($request->input('event_time')));
            $contact_event->event_type_id = $request->input('event_type_id');
            $contact_event->contact_id    = $contact_id;
            $contact_event->user_id       = $request->input('user_id');
            $contact_event->location      = $request->input('location');
            $contact_event->description   = $request->input('description');
            $contact_event->save();

            //Adding history - Start
            if($contact_event) {
                $user_id    = Auth::user()->id;
                $contact_id = Hashids::decode($request->input('contact_id'))[0];
                $ch = new ContactHistory;
                $ch->user_id       = $user_id;
                $ch->contact_id    = $contact_id;
                $ch->company_id    = 0;
                $ch->title         = "Add New Event";
                $ch->description   = "Assigned to User Id: " . $request->input('user_id');
                $ch->module        = "Events";
                $ch->save();
            }
            //Adding history - End

            Session::flash('message', 'You have successfully created new event');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();

        }else{
            Session::flash('message', 'Unable to create new event');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();
        }
    } 

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'title'           => 'required',
                'event_date'      => 'required',
                'location'        => 'required',
                'description'     => 'required',
             ]);

            $id = Hashids::decode($request->input('id'))[0];
            $contact_event = ContactEvent::find($id);
            if($contact_event) {
	            $contact_event->title       = $request->input('title');
	            $contact_event->event_date  = $request->input('event_date');
	            $contact_event->event_time  = date( "H:i:s",strtotime($request->input('event_time')));
	            $contact_event->event_type_id = $request->input('event_type_id');
	            $contact_event->user_id       = $request->input('user_id');
	            $contact_event->location      = $request->input('location');
	            $contact_event->description   = $request->input('description');
                $contact_event->save();

                //Add History - Start
                if($contact_event) {
                    $user_id    = Auth::user()->id;
                    $contact_id = Hashids::decode($request->input('contact_id'))[0];
                    $ch = new ContactHistory;
                    $ch->user_id       = $user_id;
                    $ch->contact_id    = $contact_id;
                    $ch->company_id    = 0;
                    $ch->title         = "Update Event";
                    $ch->description   = "Assigned to User Id: " . $request->input('user_id');
                    $ch->module        = "Events";
                    $ch->save();
                }
                //Add History - End

                Session::flash('message', 'Event has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();
            }
        }

        Session::flash('message', 'Unable to update Event');
        Session::flash('alert_class', 'alert-danger');
        return redirect()->back();
    }    

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $event = ContactEvent::find($id);

            if($event) {   
                $contact_id = $event->contact_id;
                $event_id   = $id;
                $event->delete();

                //Add History - Start
                $user_id    = Auth::user()->id;
                $ch = new ContactHistory;
                $ch->user_id       = $user_id;
                $ch->contact_id    = $contact_id;
                $ch->company_id    = 0;
                $ch->title         = "Delete Event";
                $ch->description   = "Event Id: " . $event_id;
                $ch->module        = "Events";
                $ch->save();
                //Add History - End

                Session::flash('message', "Event Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();
            }
        }
    }         
}
