<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\NoteType;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class NoteTypeController extends Controller
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

            return $next($request);     
        });           
    }

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            $note_type_query = NoteType::query();

            if($search_by != '' && $search_field != '') {
                $note_type_query = $note_type_query->where('note_types.'.$search_by, 'like', '%' . $search_field . '%');
                $note_types = $note_type_query->paginate(15);
            }            
        } else {
            $note_types = NoteType::paginate(15);
        }

        return view('note_type.index',[
        	'note_types' => $note_types,
            'search_field' => $search_field
        ]); 
    }

    public function create()
    {
        return view('note_type.create', [
            
        ]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'           => 'required'      
             ]);

            $noteType       = new NoteType;
            $noteType->name = $request->input('name');
            $noteType->save();

            Session::flash('message', 'You have successfully created new note type');
            Session::flash('alert_class', 'alert-success');
            return redirect('note_type');

        }else{
            Session::flash('message', 'Unable to create new note type');
            Session::flash('alert_class', 'alert-danger');  
            return redirect('note_type');
        }
    }

    public function edit($id)
    {     
        $id = Hashids::decode($id)[0];
        $note_type   = NoteType::where('id', '=', $id)->first();

        return view('note_type.edit', [
            'note_type' => $note_type
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
            $note_type = NoteType::find($id);
            if($note_type) {
                $note_type->name = $request->input('name');
                $note_type->save();

                Session::flash('message', 'Note Type has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('note_type');
            }
        }

        Session::flash('message', 'Unable to update Note Type');
        Session::flash('alert_class', 'alert-danger');
        return redirect('note_type');
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $note_type = NoteType::find($id);

            if($note_type) {   
                $note_type->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('note_type');
            }
        }
    }
}