<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 2-10-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Services\Business\SecurityService;
use App\Services\Business\UserInfoService;
use App\Services\Business\AddressService;

class RegistrationController extends Controller
{

    // Function recives user registration input, uses it to create a user object and then uses that object
    // to attempt to create a new database entry
    public function index(Request $request)
    {
        try {
            //Validates the user's input against pre-defined rules
            $this->validateForm($request);

            // Takes user input from register form and uses it to make a new usermodel object with an id of 0
            $user = new UserModel(0, $request->input('username'), $request->input('password'), $request->input('email'), $request->input('firstname'), $request->input('lastname'), 1, 0);

            // Creates instance of security service
            $securityService = new SecurityService();

            // Stores the result of the attempted registration
            $result = $securityService->register($user);

            // If the user was successfully entered into the database
            if ($result['result']) {
                //Gets the newly created user's ID
                $userID = $result['insertID'];

                //Creates instances of the business services having to do with user information
                $infoService = new UserInfoService();
                $addressService = new AddressService();

                //Creates new entries in information tables corresponding to the user with the new user's ID
                $infoService->createUserInfo($userID);
                $addressService->createAddress($userID);
            }

            // Stores the result of the attempted registration
            $data = [
                'result' => $result
            ];

            return view('registrationResult')->with($data);
        } catch (\Exception $e) {}
    }

    //Contains the rules for validating the user's registration information
    private function validateForm(Request $request)
    {
        $rules = [
            'username' => 'Required | Between:4,10 | Alpha',
            'password' => 'Required | Between:4,10',
            'email' => 'Required | email',
            'firstname' => 'Required | Between:3,15 | Alpha',
            'lastname' => 'Required | Between:3,15 | Alpha'
        ];
        
        $this->validate($request, $rules);
    }
}
