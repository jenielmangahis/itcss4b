<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\ContactDocs;
use App\ContactTask;

use UserHelper;
use GlobalHelper;
use Image;
use View;
use Hash;
use Hashids;

use Session;



class ContactDocsController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');       
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'contact_docs';
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

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                //'document_title'           => 'required',
                'filename' => 'required',
                'document_type' => 'required',
                'description' => 'required'
             ]);

            if($request->file('filename')) {
                $doc_file        = $request->file('filename');
                $original_filename = $doc_file->getClientOriginalName();
                //$doc_filename      = md5(date("Y-m-d") . "-" . rand()) . '.' . $doc_file->getClientOriginalExtension();
                $doc_filename      = $original_filename;
                $destinationPath   = public_path('/uploads/contact_docs');
                $doc_file->move($destinationPath, $doc_filename);
                $location          = $destinationPath . "/" . $doc_filename;
            }

            $user_id = Auth::user()->id;
            $contact_id      = Hashids::decode($request->input('contact_id'))[0];                 
            $contactDoc              	= new ContactDocs;
            $contactDoc->user_id        = $user_id;
            $contactDoc->contact_id     = $contact_id;
            $contactDoc->filename       = $doc_filename;
            $contactDoc->document_title = $original_filename;
            $contactDoc->document_type  = $request->input('document_type');
            $contactDoc->description    = $request->input('description');
            $contactDoc->save();

            Session::flash('message', 'You have successfully uploaded new document');
            Session::flash('alert_class', 'alert-success');
        }else{
            Session::flash('message', 'Unable to upload document');
            Session::flash('alert_class', 'alert-danger');              
        }
        return redirect()->back();	  
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $contact_doc = ContactDocs::find($id);

            if($contact_doc) {   
                $contact_doc->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');                
            }
        }
        return redirect()->back();    
    }
}
