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

    // Function recieves user login input, then authenticates user input against database entries
    public function index(Request $request)
    {
        $this->validateForm($request);

        // Get user form input from request
        $user = new LoginModel($request->input('username'), $request->input('password'));

        // Creates an instance of the security service class
        $securityService = new SecurityService();
        
        $results = $securityService->login($user);
        
        // Stores result from attempted login
        $data = ['result' => $results['result'], 'status' => $results['user']['STATUS']];

        return view('loginResult')->with($data);
    }

    private function validateForm(Request $request)
    {
        $rules = [
            'username' => 'Required | Between:4,10 | Alpha',
            'password' => 'Required | Between:4,10'];
        
        $this->validate($request, $rules);
    }
}
