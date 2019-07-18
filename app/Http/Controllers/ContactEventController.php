<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\ContactEvent;
use App\EventType;

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

            $contact_event              = new ContactEvent;
            $contact_event->title       = $request->input('title');
            $contact_event->event_date  = $request->input('event_date');
            $contact_event->event_time  = date( "H:i:s",strtotime($request->input('event_time')));
            $contact_event->event_type_id = $request->input('event_type_id');
            $contact_event->user_id       = $request->input('user_id');
            $contact_event->location      = $request->input('location');
            $contact_event->description   = $request->input('description');
            $contact_event->save();

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
                $event->delete();
                Session::flash('message', "Event Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();
            }
        }
    }         
}
