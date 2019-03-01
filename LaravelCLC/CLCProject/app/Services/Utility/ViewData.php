<?php

namespace App\Services\Utility;

use App\Services\Business\UserService;
use App\Services\Business\AddressService;
use App\Services\Business\UserInfoService;
use App\Services\Business\EducationService;
use App\Services\Business\ExperienceService;
use App\Services\Business\SkillService;
use App\Services\Business\AffinityGroupService;
use App\Services\Business\AffinityMemberService;

class ViewData{
    
    public static function getProfileData(int $userID){
        
        // Gets the user's info from the user table, address table, and the info table
        $userService = new UserService();
        $addressService = new AddressService();
        $infoService = new UserInfoService();
        $educationService = new EducationService();
        $experienceService = new ExperienceService();
        $skillService = new SkillService();
        
        // Stores the results for the user from all of the tables accessed
        $user = $userService->findByID($userID);
        $infoResults = $infoService->findByUserID($userID);
        $addressResults = $addressService->findByUserID($userID);
        $educationResults = $educationService->findByID($userID);
        $experienceResults = $experienceService->findByID($userID);
        $skillResults = $skillService->findByID($userID);
        
        // Stores all of the needed retrieved data in an associative array to be passed to the user profile view for display
        $data = [
            'ID' => $userID,
            'user' => $user['user'],
            'info' => $infoResults['userInfo'],
            'address' => $addressResults['address'],
            'educations' => $educationResults['education'],
            'experiences' => $experienceResults['experience'],
            'skills' => $skillResults['skills']
        ];
        
        return $data;
    }
    
    public static function getAffinityData(int $userID){
        
        $groupsService = new AffinityGroupService();
        $membersService = new AffinityMemberService();
        
        $owned = $groupsService->getAllOwned($userID);
        $joined = $membersService->getAllJoined($userID);
        $suggested = $groupsService->getAllSuggested($userID);
        
        $data = [
            'owned' => $owned,
            'joined' => $joined,
            'suggested' => $suggested
        ];
        
        return $data;
    }
}