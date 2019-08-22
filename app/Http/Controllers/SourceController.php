<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Source;
use App\ContactTask;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class SourceController extends Controller
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
            $source_query = Source::query();

            if($search_by != '' && $search_field != '') {
                $source_query = $source_query->where('sources.'.$search_by, 'like', '%' . $search_field . '%');
                $sources = $source_query->paginate(15);
            }            
        } else {
            $sources = Source::paginate(15);
        }

        return view('source.index',[
        	'sources' => $sources,
            'search_field' => $search_field
        ]); 
    }

    public function create()
    {
        return view('source.create', [
            
        ]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'           => 'required'      
             ]);

            $source                 = new Source;
            $source->name           = $request->input('name');
            $source->save();

            Session::flash('message', 'You have successfully created new source');
            Session::flash('alert_class', 'alert-success');
            return redirect('source');

        }else{
            Session::flash('message', 'Unable to create new source');
            Session::flash('alert_class', 'alert-danger');  
            return redirect('source');
        }
    }

    public function edit($id)
    {     
        $id = Hashids::decode($id)[0];
        $source   = Source::where('id', '=', $id)->first();

        return view('source.edit', [
            'source' => $source
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
            $source = Source::find($id);
            if($source) {
                $source->name = $request->input('name');
                $source->save();

                Session::flash('message', 'Source has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('source');
            }
        }

        Session::flash('message', 'Unable to update Source');
        Session::flash('alert_class', 'alert-danger');
        return redirect('source');
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $source = Source::find($id);

            if($source) {   
                $source->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('source');
            }
        }
    }
}
