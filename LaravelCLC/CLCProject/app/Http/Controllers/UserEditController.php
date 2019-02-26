<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 2-24-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Business\UserInfoService;
use App\Services\Business\AddressService;
use App\Models\UserInfoModel;
use App\Models\AddressModel;
use App\Services\Utility\ViewData;

class UserEditController extends Controller
{
    // Takes user input from the previous form and passes it along so that a user can edit their info in the database
    public function editUserInfo(Request $request)
    {
        Log::info("Entering UserEditController.editUserInfo()");

        // Validates the user's input against pre-defined rules
        $this->validateInfoInput($request);

        try {

            // Gets all of the input from the previous form and uses it to create a new user info object
            $info = new UserInfoModel(0, $request->input('description'), $request->input('phone'), $request->input('age'), $request->input('gender'), $request->input('userID'));

            // Creates instance of the appropriate business service
            $service = new UserInfoService();

            // Stores the result of the database query to edit the user's info according to the info in the model passed
            $results = $service->editUserInfo($info);

            Log::info("Exiting UserEditController.editUserInfo() with a result of " . $results);

            return view('userProfile')->with(ViewData::getProfileData($request->session()->get('ID')));
        } catch (\Exception $e) {
            Log::error("Exception occurred in UserEditController.editUserInfo(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }

    // Method contains rules for validating user info input before submitting it to the database
    private function validateInfoInput(Request $request)
    {
        $rules = [
            'phone' => 'Numeric',
            'age' => 'Numeric',
            'gender' => 'Alpha'
        ];

        $this->validate($request, $rules);
    }

    // Takes user input from the previous form and passes it along so that a user can edit their address in the database
    public function editAddress(Request $request)
    {
        Log::info("Entering UserEditController.editAddress()");

        // Validates the user's input against pre-defined rules
        $this->validateAddressInput($request);
        
        try {

            // Gets all of the input from the previous form and uses it to create a new address object
            $address = new AddressModel(0, $request->input('street'), $request->input('city'), $request->input('state'), $request->input('zip'), $request->input('userID'));

            // Creates instance of the appropriate business service
            $service = new AddressService();

            // Stores the result of the database query to edit the user's address according to the info in the model passed
            $results = $service->editAddress($address);

            Log::info("Exiting UserEditController.editAddress() with a result of " . $results);

            return view('userProfile')->with(ViewData::getProfileData($request->session()->get('ID')));
        } catch (\Exception $e) {
            Log::error("Exception occurred in UserEditController.editAddress(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }

    // Method contains rules for validating address input before submitting it to the database
    private function validateAddressInput(Request $request)
    {
        $rules = [
            'street' => 'Required',
            'city' => 'Required | Alpha',
            'state' => 'Required | Alpha',
            'zip' => 'Required | Numeric'
        ];
        
        $this->validate($request, $rules);
    }
}
