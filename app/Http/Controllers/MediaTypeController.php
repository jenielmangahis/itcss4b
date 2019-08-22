<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\MediaType;
use App\ContactTask;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class MediaTypeController extends Controller
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

            View::share ( 'pending_task_count', $pending_task_count );   
            View::share ( 'pending_task', $pending_task);               

            return $next($request);     
        });           
    }

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            $media_type_query = MediaType::query();

            if($search_by != '' && $search_field != '') {
                $media_type_query = $media_type_query->where('media_types.'.$search_by, 'like', '%' . $search_field . '%');
                $media_types = $media_type_query->paginate(15);
            }            
        } else {
            $media_types = MediaType::paginate(15);
        }

        return view('media_type.index',[
        	'media_types' => $media_types,
            'search_field' => $search_field
        ]); 
    }

    public function create()
    {
        return view('media_type.create', [
            
        ]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'           => 'required'      
             ]);

            $mediaType                 = new MediaType;
            $mediaType->name           = $request->input('name');
            $mediaType->save();

            Session::flash('message', 'You have successfully created new media type');
            Session::flash('alert_class', 'alert-success');
            return redirect('media_type');

        }else{
            Session::flash('message', 'Unable to create new media type');
            Session::flash('alert_class', 'alert-danger');  
            return redirect('media_type');
        }
    }

    public function edit($id)
    {     
        $id = Hashids::decode($id)[0];
        $media_type   = MediaType::where('id', '=', $id)->first();

        return view('media_type.edit', [
            'media_type' => $media_type
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
            $media_type = MediaType::find($id);
            if($media_type) {
                $media_type->name = $request->input('name');
                $media_type->save();

                Session::flash('message', 'Media Type has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('media_type');
            }
        }

        Session::flash('message', 'Unable to update Media Type');
        Session::flash('alert_class', 'alert-danger');
        return redirect('media_type');
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $media_type = MediaType::find($id);

            if($media_type) {   
                $media_type->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('media_type');
            }
        }
    }
}
