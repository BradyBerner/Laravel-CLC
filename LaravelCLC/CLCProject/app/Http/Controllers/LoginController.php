<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 1-20-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Http\Controllers;

use App\Models\LoginModel;
use Illuminate\Http\Request;
use App\Services\Business\SecurityService;

class LoginController extends Controller
{
    //Function recieves user login input, then authenticates user input against database entries
    public function index(Request $request)
    {
        //Get user form input from request
        $user = new LoginModel($request->input('uname'), $request->input('pword'));
        
        $this->validateForm($request);
        
        //Creates an instance of the security service class
        $securityService = new SecurityService();

        //Stores result from attempted login
        $result = $securityService->login($user);
        
        //Redirects the user to the appropriate page based on the result of their login attempt
        if($result){
            return view('loginSuccess');
        } else {
            return view('loginFail');
        }
    }
    
    private function validateForm(Request $request){
        $rules = ['uname' => 'Required | Between:4,10 | Alpha', 'pword' => 'Required | Between:4,10'];
        
        $this->validate($request, $rules);
    }
}
