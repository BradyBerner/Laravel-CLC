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
use App\Services\Business\AddressService;
use App\Services\Business\UserInfoService;
use App\Services\Business\UserService;
use App\Services\Business\EducationService;
use App\Services\Business\ExperienceService;

class UserProfileController extends Controller
{

    // Takes the request that contains the ID for the user's profile that it's suposed to display
    public function index(Request $request)
    {
        try {
            Log::info("Entering UserProfileController.index()");

            // Gets the user ID from the previous form
            $userID = $request->input('ID');

            // Gets the user's info from the user table, address table, and the info table
            $userService = new UserService();
            $addressService = new AddressService();
            $infoService = new UserInfoService();
            $educationService = new EducationService();
            $experienceService = new ExperienceService();

            // Stores the results for the user from all of the tables accessed
            $user = $userService->findByID($userID);
            $infoResults = $infoService->findByUserID($userID);
            $addressResults = $addressService->findByUserID($userID);
            $educationResults = $educationService->findByID($userID);
            $experienceResults = $experienceService->findByID($userID);

            // Stores all of the needed retrieved data in an associative array to be passed to the user profile view for display
            $data = [
                'ID' => $userID,
                'user' => $user['user'],
                'info' => $infoResults['userInfo'],
                'address' => $addressResults['address'],
                'educations' => $educationResults['education'],
                'experiences' => $experienceResults['experience']
            ];

            Log::info("Exiting UserProfileController.index()");
        
        return view('userProfile')->with($data);
        } catch (\Exception $e){
            Log::error("Exception occurred in UserProfileController.index(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
}
