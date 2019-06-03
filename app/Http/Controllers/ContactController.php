<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contact;

use View;
use Hash;
use Hashids;

use Session;

class ContactController extends Controller
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
            $contact_query = Contact::query();

            if($search_by != '' && $search_field != '') {
                $contact_query = $contact_query->where('contacts.'.$search_by, 'like', '%' . $search_field . '%');
                $contact = $contact_query->paginate(15);
            }            
        } else {
            $contact = Contact::paginate(15);
        }

        return view('contact.index',[
        	'contact' => $contact,
            'search_field' => $search_field
        ]); 
    } 
}
