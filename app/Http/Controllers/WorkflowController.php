<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Workflow;
use App\WorkflowCategory;
use App\Stage;

use View;
use Hash;
use Hashids;

use Session;

class WorkflowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');       
    }

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            $workflow_query = Workflow::query();

            if($search_by != '' && $search_field != '') {
            	if( $search_by == 'category_name' ){
            		$workflow_query = $workflow_query->where('workflow_category.name', 'like', '%' . $search_field . '%');
            	}elseif( $search_by == 'stage_name' ){
            		$workflow_query = $workflow_query->where('stage.name', 'like', '%' . $search_field . '%');
            	}else{
            		$workflow_query = $workflow_query->where('workflow.'.$search_by, 'like', '%' . $search_field . '%');	
            	}
                
                $workflow = $workflow_query->paginate(15);
            }            
        } else {
            $workflow = Workflow::paginate(15);
        }

        return view('workflow.index',[
        	'workflow' => $workflow,
            'search_field' => $search_field
        ]); 
    }

    public function create()
    {
    	$workflowCategories = WorkflowCategory::get();
    	$stages = Stage::get();

        return view('workflow.create', [
            'workflowCategories' => $workflowCategories,
            'stages' => $stages
        ]);
    }

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'workflow_category_id' => 'required',
                'stage_id' => 'required',
                'status' => 'required',
                'color_code' => 'required'
             ]);

            $workflow                 = new Workflow;
            $workflow->workflow_category_id    = $request->input('workflow_category_id');
            $workflow->stage_id   = $request->input('stage_id');
            $workflow->status     = $request->input('status');
            $workflow->color_code = $request->input('color_code');
            $workflow->save();

            Session::flash('message', 'You have successfully created new workflow');
            Session::flash('alert_class', 'alert-success');
            return redirect('workflow');

        }else{
            Session::flash('message', 'Unable to create new workflow');
            Session::flash('alert_class', 'alert-danger');
            return redirect('workflow/create');            
        }
    }

    public function edit($id)
    {     
        $id = Hashids::decode($id)[0];
        $workflow   = Workflow::where('id', '=', $id)->first();

        $workflowCategories = WorkflowCategory::get();
    	$stages = Stage::get();

        return view('workflow.edit', [
            'workflow' => $workflow,
            'workflowCategories' => $workflowCategories,
            'stages' => $stages
        ]);
    }

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'workflow_category_id' => 'required',
                'stage_id' => 'required',
                'status' => 'required',
                'color_code' => 'required'     
             ]);

            $id = Hashids::decode($request->input('id'))[0];
            $workflow = Workflow::find($id);
            if($workflow) {
                $workflow->workflow_category_id = $request->input('workflow_category_id');
	            $workflow->stage_id   = $request->input('stage_id');
	            $workflow->status     = $request->input('status');
	            $workflow->color_code = $request->input('color_code');
                $workflow->save();

                Session::flash('message', 'Workflow has been updated');
                Session::flash('alert_class', 'alert-success');
                return redirect('workflow');
            }
        }

        Session::flash('message', 'Unable to update workflow');
        Session::flash('alert_class', 'alert-danger');
        return redirect('workflow');
    }

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $workflow = Workflow::find($id);

            if($workflow) {   
                $workflow->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('workflow');
            }
        }
    }
}
