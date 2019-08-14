<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\ContactNote;

use UserHelper;
use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;

class ContactNoteController extends Controller
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
                'note_title'      => 'required',
                'note_content'    => 'required',
                'cc_emails'       => 'email',
             ]);

            $contact_id = $request->input('contact_id');
            $contact_id = Hashids::decode($contact_id)[0];

            $contact_note               = new ContactNote;
            $contact_note->contact_id   = $contact_id;  
            $contact_note->note_type_id = $request->input('note_type_id');
            $contact_note->note_title   = $request->input('note_title');
            $contact_note->note_content = $request->input('note_content');
            $contact_note->notify_user_id = $request->input('notify_user_id');
            $contact_note->cc_emails      = $request->input('cc_emails');
            $contact_note->save();

            Session::flash('message', 'You have successfully created note');
            Session::flash('alert_class', 'alert-success');
            return redirect()->back();

        }else{
            Session::flash('message', 'Unable to create new note');
            Session::flash('alert_class', 'alert-danger');  
            return redirect()->back();
        }
    } 

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $note = ContactNote::find($id);

            if($note) {   
                $note->delete();
                Session::flash('message', "Note Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect()->back();
            }
        }
    }     

}
