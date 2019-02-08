<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Business\AddressService;
use App\Services\Business\UserInfoService;
use App\Services\Business\UserService;

class UserProfileController extends Controller
{
    public function index(Request $request){
        
        Log::info("Entering UserProfileController.index()");
        
        $userID = $request->input('ID');
        
        $userService = new UserService();
        $addressService = new AddressService();
        $infoService = new UserInfoService();
        
        $user = $userService->findByID($userID);
        $infoResults = $infoService->findByUserID($userID);
        $addressResults = $addressService->findByUserID($userID);
        
        $data = ['ID' => $userID, 'user' => $user['user'], 'info' => $infoResults['userInfo'], 'address' => $addressResults['address']];
        
        Log::info("Exiting UserProfileController.index()");
        
        return view('userProfile')->with($data);
    }
}
