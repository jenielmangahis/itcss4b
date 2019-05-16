<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;
use Route;

class BenchmarkController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function lte_fixed(Request $request)
    {
        return view('lte.lte_fixed',[
        ]); 
    }
}
