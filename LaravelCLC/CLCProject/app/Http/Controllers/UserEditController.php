<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Business\UserInfoService;
use App\Services\Business\AddressService;
use App\Models\UserInfoModel;
use App\Models\AddressModel;

class UserEditController extends Controller
{
    public function getLinkedInfo(Request $request){
        
        Log::info("Entering UserEditController.getLinkedInfo()");
        
        $userID = $request->input('ID');
        
        $infoService = new UserInfoService();
        $addressService = new AddressService();
        
        $infoResults = $infoService->findByUserID($userID);
        $addressResults = $addressService->findByUserID($userID);
        
        $data = ['infoResult' => $infoResults['result'], 'addressResult' => $addressResults['result'], 'info' => $infoResults['userInfo'], 'address' => $addressResults['address']];
        
        Log::info("Exiting UserEditController.getLinkedInfo()");
        
        return view('editUserProfile')->with($data);
    }
    
    public function editUserInfo(Request $request){
        
        Log::info("Entering UserEditController.editUserInfo()");
        
        //TODO::ask Reha if there's a way to do custom validation redirects
        $this->validateInfoInput($request);
        
        $info = new UserInfoModel(0, $request->input('description'), $request->input('phone'), $request->input('age'), $request->input('gender'), $request->input('userID'));
        
        $service = new UserInfoService();
        
        $results = $service->editUserInfo($info);
        
        Log::info("Exiting UserEditController.editUserInfo() with a result of " . $results);
        
        return view('home');
    }
    
    private function validateInfoInput(Request $request){
        $rules = [
            'phone' => 'Numeric',
            'age' => 'Numeric',
            'gender' => 'Alpha'
        ];
        
        $this->validate($request, $rules);
    }
    
    public function editAddress(Request $request){
        
        Log::info("Entering UserEditController.editAddress()");
        
        //TODO::ask Reha if there's a way to do custom validation redirects
        $this->validateAddressInput($request);
        
        $address = new AddressModel(0, $request->input('street'), $request->input('city'), $request->input('state'), $request->input('zip'), $request->input('userID'));
        
        $service = new AddressService();
        
        $results = $service->editAddress($address);
        
        Log::info("Exiting UserEditController.editAddress() with a result of " . $results);
        
        return view('home');
    }
    
    private function validateAddressInput(Request $request){
        $rules = [
            'street' => 'Required',
            'city' => 'Required | Alpha',
            'state' => 'Required | Alpha',
            'zip' => 'Required | Numeric'
        ];
        
        $this->validate($request, $rules);
    }
}
