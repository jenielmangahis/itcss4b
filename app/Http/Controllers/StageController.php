<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Stage;
use App\ContactTask;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class StageController extends Controller
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
            $stage_query = Stage::query();

            if($search_by != '' && $search_field != '') {
                $stage_query = $stage_query->where('stages.'.$search_by, 'like', '%' . $search_field . '%');
                $stage = $stage_query->paginate(15);
            }            
        } else {
            $stage = Stage::paginate(15);
        }

        return view('stage.index',[
        	'stage' => $stage,
            'search_field' => $search_field
        ]); 
    }

    public function create()
    {
        return view('stage.create', [
            
        ]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'           => 'required'      
             ]);

            $worflowCategory                 = new Stage;
            $worflowCategory->name           = $request->input('name');
            $worflowCategory->save();

            Session::flash('message', 'You have successfully created new stage');
            Session::flash('alert_class', 'alert-success');
            return redirect('stage');

        }else{
            Session::flash('message', 'Unable to create new stage');
            Session::flash('alert_class', 'alert-danger');
            return redirect('stage/create');            
            return redirect('stage');
        }
    }

    public function edit($id)
    {     
        $id = Hashids::decode($id)[0];
        $stage   = Stage::where('id', '=', $id)->first();

        return view('stage.edit', [
            'stage' => $stage
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
            $stage = Stage::find($id);
            if($stage) {
                $stage->name = $request->input('name');
                $stage->save();

                Session::flash('message', 'Workflow Category has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('stage');
            }
        }

        Session::flash('message', 'Unable to update stage');
        Session::flash('alert_class', 'alert-danger');
        return redirect('stage');
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $stage = Stage::find($id);

            if($stage) {   
                $stage->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('stage');
            }
        }
    }
}
