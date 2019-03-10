<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-3-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Utility\MyLogger;
use App\Services\Utility\ViewData;

class UserProfileController extends Controller
{

    // Takes the request that contains the ID for the user's profile that it's suposed to display
    public function index(Request $request)
    {
        try {
            MyLogger::getLogger()->info("Entering UserProfileController.index()");

            // Gets the user ID from the previous form
            $userID = $request->input('ID');

            MyLogger::getLogger()->info("Exiting UserProfileController.index()");
        
            return view('userProfile')->with(ViewData::getProfileData($userID));
        } catch (\Exception $e){
            MyLogger::getLogger()->error("Exception occurred in UserProfileController.index(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
}
