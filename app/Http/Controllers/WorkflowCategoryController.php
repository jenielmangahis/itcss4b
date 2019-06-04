<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\WorkflowCategory;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class WorkflowCategoryController extends Controller
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
                Session::flash('message', 'You have no permission to access '. $module . ' the page.');
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
            $workflow_category_query = WorkflowCategory::query();

            if($search_by != '' && $search_field != '') {
                $workflow_category_query = $workflow_category_query->where('workflow_categories.'.$search_by, 'like', '%' . $search_field . '%');
                $workflow_category = $workflow_category_query->paginate(15);
            }            
        } else {
            $workflow_category = WorkflowCategory::paginate(15);
        }

        return view('workflow_category.index',[
        	'workflow_category' => $workflow_category,
            'search_field' => $search_field
        ]); 
    }

    public function create()
    {
        return view('workflow_category.create', [
            
        ]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'           => 'required'      
             ]);

            $worflowCategory                 = new WorkflowCategory;
            $worflowCategory->name           = $request->input('name');
            $worflowCategory->save();

            Session::flash('message', 'You have successfully created new workflow category');
            Session::flash('alert_class', 'alert-success');
            return redirect('workflow_category');

        }else{
            Session::flash('message', 'Unable to create new workflow category');
            Session::flash('alert_class', 'alert-danger');
            return redirect('workflow_category/create');            
            return redirect('workflow_category');
        }
    }

    public function edit($id)
    {     
        $id = Hashids::decode($id)[0];
        $workflow_category   = WorkflowCategory::where('id', '=', $id)->first();

        return view('workflow_category.edit', [
            'workflow_category' => $workflow_category
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
            $workflow_category = WorkflowCategory::find($id);
            if($workflow_category) {
                $workflow_category->name = $request->input('name');
                $workflow_category->save();

                Session::flash('message', 'Workflow Category has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('workflow_category');
            }
        }

        Session::flash('message', 'Unable to update workflow category');
        Session::flash('alert_class', 'alert-danger');
        return redirect('workflow_category');
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $workflow_category = WorkflowCategory::find($id);

            if($workflow_category) {   
                $workflow_category->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('workflow_category');
            }
        }
    }    
}
