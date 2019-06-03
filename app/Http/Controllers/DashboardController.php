<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use GlobalHelper;

use View;
use Hash;
use Hashids;

use Session;
use Route;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');       
    }

    public function index(Request $request)
    {
        return view('dashboard.index',[
        ]); 
    }
}
