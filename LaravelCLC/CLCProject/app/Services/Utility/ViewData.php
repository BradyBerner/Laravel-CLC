<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-3-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Utility;

use App\Services\Business\UserService;
use App\Services\Business\AddressService;
use App\Services\Business\UserInfoService;
use App\Services\Business\EducationService;
use App\Services\Business\ExperienceService;
use App\Services\Business\SkillService;
use App\Services\Business\AffinityGroupService;
use App\Services\Business\AffinityMemberService;
use App\Services\Business\JobApplicantService;

class ViewData{
    
    public static function getProfileData(int $userID){
        
        MyLogger::getLogger()->info("Entering ViewData.getProfileData()", ['UserID' => $userID]);
        
        // Gets the user's info from the user table, address table, and the info table
        $userService = new UserService();
        $addressService = new AddressService();
        $infoService = new UserInfoService();
        $educationService = new EducationService();
        $experienceService = new ExperienceService();
        $skillService = new SkillService();
        $applicantService = new JobApplicantService();
        
        // Stores the results for the user from all of the tables accessed
        $user = $userService->findByID($userID);
        $infoResults = $infoService->findByUserID($userID);
        $addressResults = $addressService->findByUserID($userID);
        $educationResults = $educationService->findByID($userID);
        $experienceResults = $experienceService->findByID($userID);
        $skillResults = $skillService->findByID($userID);
        $jobResults = $applicantService->getAllJobs($userID);
        
        // Stores all of the needed retrieved data in an associative array to be passed to the user profile view for display
        $data = [
            'ID' => $userID,
            'user' => $user['user'],
            'info' => $infoResults['userInfo'],
            'address' => $addressResults['address'],
            'educations' => $educationResults['education'],
            'experiences' => $experienceResults['experience'],
            'skills' => $skillResults['skills'],
            'appliedJobs' => $jobResults
        ];
        
        MyLogger::getLogger()->info("Exiting ViewData.getProfileData()", ['data' => $data]);
        
        return $data;
    }
    
    //Gets all of the affinity group data for a particular user when viewing the affinity group page
    public static function getAffinityData(int $userID){
        
        MyLogger::getLogger()->info("Entering ViewData.getAffinityData()", ['UserID' => $userID]);
        
        //Creates instances of all the necessary services
        $groupsService = new AffinityGroupService();
        $membersService = new AffinityMemberService();
        $skillService = new SkillService();
        
        //Gets neccessary results from all services
        $owned = $groupsService->getAllOwned($userID);
        $joined = $membersService->getAllJoined($userID);
        $all = $groupsService->getAll($userID);
        $skills = $skillService->findByID($userID);
        $notJoined = [];
        
        //Fills notJoined array with all groups that the user is not a part of or owns
        for($i = 0; $i < count($all); $i++){
            $valid = true;
            $id = $all[$i]['IDAFFINITYGROUPS'];
            
            foreach($owned as $group){
                if($group['IDAFFINITYGROUPS'] == $id){
                    $valid = false;
                }
            }
            
            foreach($joined as $group){
                if($group['IDAFFINITYGROUPS'] == $id){
                    $valid = false;
                }
            }
            
            if($valid){
                array_push($notJoined, $all[$i]);
            }
        }
            
        $suggested = [];
        
        //Fills the suggested array with all groups that are valid suggestions from the notJoined array
        foreach($skills['skills'] as $skill){
            foreach($notJoined as $group){
                if($group['FOCUS'] == $skill['SKILL'] && $group['USERS_IDUSERS'] != $userID){
                    array_push($suggested, $group);
                }
            }
        }
        
        //Data array to be returned to the view
        $data = [
            'ID' => $userID,
            'owned' => ViewData::addMembersToGroupData($owned),
            'joined' => ViewData::addMembersToGroupData($joined),
            'suggested' => ViewData::addMembersToGroupData($suggested),
            'skills' => $skills['skills']
        ];
        
        MyLogger::getLogger()->info("Exiting ViewData.getAffinityData()", ['data' => $data]);
        
        return $data;
    }
    
    /*
     * Method for getting all the members in a group and adding them to the existing affinity group array
     * to be returned to the view
     */
    private static function addMembersToGroupData($groups){
        
        MyLogger::getLogger()->info("Entering ViewData.addMembersToGroupData()");
        
        //Creates instances of necessary business services
        $membersService = new AffinityMemberService();
        $userService = new UserService();
        
        //Fills all the groups with their members
        for($i = 0; $i < count($groups); $i++){
            $members = [];
            $users = $membersService->getAllMembers($groups[$i]['IDAFFINITYGROUPS']);
            foreach($users as $user){
                $userResults = $userService->findByID($user['USERS_IDUSERS'])['user'];
                array_push($members, ['ID' => $userResults['IDUSERS'], 'USERNAME' => $userResults['USERNAME']]);
            }
            $groups[$i]['members'] = $members;
        }
        
        MyLogger::getLogger()->info("Exiting ViewData.addMembersToGroupData()");
        
        return $groups;
    }
}