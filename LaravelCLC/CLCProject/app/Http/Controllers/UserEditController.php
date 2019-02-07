<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Business\UserInfoService;
use App\Services\Business\AddressService;
use App\Models\UserInfoModel;

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
        
        return view('userProfile')->with($data);
    }
    
    public function editUserInfo(Request $request){
        
        Log::info("Entering UserEditController.editUserInfo()");
        
        $this->validateInfoInput($request);
        
        $info = new UserInfoModel(0, $request->input('description'), $request->input('phone'), $request->input('age'), $request->input('gender'), $request->input('userID'));
        
        $service = new UserInfoService();
        
        $results;
    }
    
    private function validateInfoInput(Request $request){
        
        $rules = [
            'phone' => 'numeric',
            'age' => 'integer',
            'gender' => 'alpha'
        ];
        
        $this->validate($request, $rules);
    }
}
