<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Workflow;
use App\WorkflowCategory;
use App\Stage;
use App\ContactTask;
use App\ContactHistory;
use App\ContactBusinessInformation;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class WorkflowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');       
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'workflow';
            $with_permission = UserHelper::checkUserRole($group_id, $module); 
            if(!$with_permission) {
                Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                Session::flash('alert_class', 'alert-danger');                
                return redirect('dashboard');
            }    

            $pending_task_count = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->count();
            $pending_task       = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->get();

            $bankruptcy         = ContactBusinessInformation::where('filed_bankruptcy','=','Yes')->where('bankruptcy_filed','<=',now()->subMonth(2))->get();

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

            View::share ( 'bankruptcy', $bankruptcy );            

            return $next($request);     
        });         
    }

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            $workflow_query = Workflow::query();
            $workflow_query->join('stages', 'stages.id', '=', 'workflows.stage_id');
            $workflow_query->join('workflow_categories', 'workflow_categories.id', '=', 'workflows.workflow_category_id');

            if($search_by != '' && $search_field != '') {
            	if( $search_by == 'category_name' ){
            		$workflow_query = $workflow_query->where('workflow_categories.name', 'like', '%' . $search_field . '%');
            	}elseif( $search_by == 'stage_name' ){
            		$workflow_query = $workflow_query->where('stages.name', 'like', '%' . $search_field . '%');
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

            //Validate if starts with # sign
            $start_char = mb_substr($request->input('color_code'), 0, 1, "UTF-8");
            $color_code = $request->input('color_code');
            if( $start_char != '#' ){
                $color_code = '#' . $color_code;
            }

            $workflow                 = new Workflow;
            $workflow->workflow_category_id    = $request->input('workflow_category_id');
            $workflow->stage_id   = $request->input('stage_id');
            $workflow->status     = $request->input('status');
            $workflow->color_code = $color_code;
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

                //Validate if starts with # sign
                $start_char = mb_substr($request->input('color_code'), 0, 1, "UTF-8");
                $color_code = $request->input('color_code');
                if( $start_char != '#' ){
                    $color_code = '#' . $color_code;
                }
            
                $workflow->workflow_category_id = $request->input('workflow_category_id');
	            $workflow->stage_id   = $request->input('stage_id');
	            $workflow->status     = $request->input('status');
	            $workflow->color_code = $color_code;
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

    public function ajax_load_stage_status(Request $request)
    {
        $workflow = Workflow::where('stage_id', '=', $request->input('stage_id'))->get();
        $status = $request->input('status');
        return view('workflow.ajax_load_stage_status_dropdown',[
            'workflow' => $workflow,
            'status' => $status
        ]);
    } 
}
