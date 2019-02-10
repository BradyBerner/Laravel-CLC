<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 2-10-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Business\UserInfoService;
use App\Services\Business\AddressService;
use App\Models\UserInfoModel;
use App\Models\AddressModel;

class UserEditController extends Controller
{

    // This method takes the ID passed through the form and returns the user's address and info to a view for editing
    public function getLinkedInfo(Request $request)
    {
        try {
            Log::info("Entering UserEditController.getLinkedInfo()");

            // Get's ID from previous form
            $userID = $request->input('ID');

            // Creates instances of the necessary services
            $infoService = new UserInfoService();
            $addressService = new AddressService();

            // Gets the user's address and info rows from the corresponding tables
            $infoResults = $infoService->findByUserID($userID);
            $addressResults = $addressService->findByUserID($userID);

            // Stores the retrieved info in an associative array to be passed on to the editing view
            $data = [
                'infoResult' => $infoResults['result'],
                'addressResult' => $addressResults['result'],
                'info' => $infoResults['userInfo'],
                'address' => $addressResults['address']
            ];

            Log::info("Exiting UserEditController.getLinkedInfo()");

            return view('editUserProfile')->with($data);
        } catch (\Exception $e) {}
    }

    // Takes user input from the previous form and passes it along so that a user can edit their info in the database
    public function editUserInfo(Request $request)
    {
        try {
            Log::info("Entering UserEditController.editUserInfo()");

            // Validates the user's input against pre-defined rules
            $this->validateInfoInput($request);

            // Gets all of the input from the previous form and uses it to create a new user info object
            $info = new UserInfoModel(0, $request->input('description'), $request->input('phone'), $request->input('age'), $request->input('gender'), $request->input('userID'));

            // Creates instance of the appropriate business service
            $service = new UserInfoService();

            // Stores the result of the database query to edit the user's info according to the info in the model passed
            $results = $service->editUserInfo($info);

            Log::info("Exiting UserEditController.editUserInfo() with a result of " . $results);

            return view('home');
        } catch (\Exception $e) {}
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
        try {
            Log::info("Entering UserEditController.editAddress()");

            // Validates the user's input against pre-defined rules
            $this->validateAddressInput($request);

            // Gets all of the input from the previous form and uses it to create a new address object
            $address = new AddressModel(0, $request->input('street'), $request->input('city'), $request->input('state'), $request->input('zip'), $request->input('userID'));

            // Creates instance of the appropriate business service
            $service = new AddressService();

            // Stores the result of the database query to edit the user's address according to the info in the model passed
            $results = $service->editAddress($address);

            Log::info("Exiting UserEditController.editAddress() with a result of " . $results);

            return view('home');
        } catch (\Exception $e) {}
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
