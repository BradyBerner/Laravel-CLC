<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 1-20-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\SecurityService;

class RegistrationController extends Controller
{

    //Function recives user registration input, uses it to create a user object and then uses that object
    //to attempt to create a new database entry
    public function index(Request $request)
    {
        $this->validateForm($request);
        
        //Takes user input from register form and uses it to make a new usermodel object with an id of 0
        $user = new UserModel(0, $request->input('username'), $request->input('password'), $request->input('email'), $request->input('fname'), $request->input('lname'), 0);
        
        //Creates instance of security service
        $securityService = new SecurityService();
        
        //Stores the result of the attempted registration
        $result = $securityService->register($user);
        
        //Directs the user to the appropriate page based on the result of the attempted registration
        if($result){
            return view('registerSuccess');
        } else {
            return view('registerFail');
        }
    }
    
    private function validateForm(Request $request){
        $rules = [
            'username' => 'Required | Between:4,10 | Alpha',
            'password' => 'Required | Between:4,10',
            'email' => 'Required',
            'fname' => 'Required | Between:3,15 | Alpha',
            'lname' => 'Required | Between:3,15 | Alpha'
        ];
        
        $this->validate($request, $rules);
    }
}
