<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Group;

use View;
use Hash;
use Hashids;

use Session;

class GroupController extends Controller
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
