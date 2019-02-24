<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 2-24-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class SignOutController extends Controller
{

    // Doesn't take any information from a previous form or anything simply logs actions flushes the session and returns to home
    public function index()
    {
        try {
            Log::info("Entering SignOutController.index()");
            // Flushing session variables will effectively log the user out of the website
            Session::flush();

            Log::info("Exiting SignOutController.index()");

            return view('home');
        } catch (\Exception $e){
            
        }
    }
}
