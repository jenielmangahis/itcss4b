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
}
