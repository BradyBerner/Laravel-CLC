<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SignOutController extends Controller
{
    public function index(){
        
        Log::info("Entering SignOutController.index()");
        
        Session::flush();
        
        Log::info("Exiting SignOutController.index()");
        
        return view('home');
    }
}
