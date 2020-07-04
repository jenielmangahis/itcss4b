<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Group;
use App\ContactTask;
use App\ContactHistory;
use App\ContactBusinessInformation;
use App\Contact;

use UserHelper;

use View;
use Hash;
use Hashids;

use Session;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');      
        $this->middleware(function ($request, $next) {

            $user_id  = Auth::user()->id;
            $group_id = Auth::user()->group_id;
            $module   = 'groups';
            $with_permission = UserHelper::checkUserRole($group_id, $module); 
            if(!$with_permission) {
                Session::flash('message', 'You have no permission to access the '. $module . ' page.');
                Session::flash('alert_class', 'alert-danger');                
                return redirect('dashboard');
            }    

            $pending_task_count = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->count();
            $pending_task       = ContactTask::where('assigned_user_id','=', $user_id)->where('status','=', 'pending')->get();

            $bankruptcy         = UserHelper::getCompaniesBankrupt();

            $idl_contacts = UserHelper::getIdleContacts();
            $idle_contacts_count = 0;
            $idle_contacts       = array();
            if(!empty($idl_contacts)) {
                $idle_contacts_count = $idl_contacts['total_idle'];
                $idle_contacts       = $idl_contacts['idle_data'];
            }
            $settled            = UserHelper::getContactsSettled();
            View::share ( 'settled', $settled );
            View::share ( 'idle_contacts_count', $idle_contacts_count );   
            View::share ( 'idle_contacts', $idle_contacts);             

            View::share ( 'pending_task_count', $pending_task_count );   
            View::share ( 'pending_task', $pending_task);               

            View::share ( 'bankruptcy', $bankruptcy);               

            return $next($request);     
        });       
    }

    public function index(Request $request)
    {
        $search_by    = $request->input('search_by');
        $search_field = $request->input('search_field');  

        if($search_by != '' && $search_field != '') {
            $groups_query = Group::query();

            if($search_by != '' && $search_field != '') {
                $groups_query = $groups_query->where('groups.'.$search_by, 'like', '%' . $search_field . '%');
                $groups = $groups_query->paginate(15);
            }            
        } else {
            $groups = Group::paginate(15);
        }

        return view('group.index',[
        	'groups' => $groups,
            'search_field' => $search_field
        ]); 
    }      

    public function create()
    {
        return view('group.create', [

        ]);
    }      

    public function store(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'        => 'required'     
             ]);

            $group = new Group;
            $group->name = $request->input('name');
            $group->save();

            if($group) {
                Session::flash('message', 'You have successfully created a group');
                Session::flash('alert_class', 'alert-success');
                return redirect('groups');                   
            }

        }

        Session::flash('message', 'Unable to add group');
        Session::flash('alert_class', 'alert-danger');
        return redirect('group/create');        

    }

    public function edit($id)
    {     
        $id    = Hashids::decode($id)[0];
        $group = Group::find($id);
        if($group) {
            return view('group.edit', [
                'group'          => $group
            ]);
        }   
    }     

    public function update(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $this->validate($request, [
                'name'        => 'required'             
             ]);

            $id = Hashids::decode($request->input('id'))[0];
            $group = Group::find($id);
            if($group) {
                $group->name = $request->input('name');
                $group->save();

                if($group) {
                    Session::flash('message', 'Group has been updated');
                    Session::flash('alert_class', 'alert-success');
                    return redirect('groups');                    
                }

            }
        }

        Session::flash('message', 'Unable to update group');
        Session::flash('alert_class', 'alert-danger');
        return redirect('groups');
    }         

    public function destroy(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $id = $request->input('id');
            $id = Hashids::decode($id)[0];
            $g = Group::find($id);

            if($g) {   
                $g->delete();
                Session::flash('message', "Delete Successful");
                Session::flash('alert_class', 'alert-success');
                return redirect('groups');
            }
        }

        Session::flash('message', 'Unable to delete group');
        Session::flash('alert_class', 'alert-danger');
        return redirect('groups');            
    }      

}
