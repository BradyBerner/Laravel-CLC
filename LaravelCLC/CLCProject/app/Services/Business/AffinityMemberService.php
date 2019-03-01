<?php

namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\Connection;
use App\Services\Data\AffinityMemberDAO;

class AffinityMemberService{
    
    public function getAllJoined($userID){
        
        Log::info("Entering AffinityMemberService.getAllJoined()");
        
        $connection = new Connection();
        
        $DAO = new AffinityMemberDAO($connection);
        
        $results = $DAO->getAllGroups($userID);
        
        $groups = [];
        $service = new AffinityGroupService();
        
        foreach($results as $result){
            $id = $result['AFFINITYGROUPS_IDAFFINITYGROUPS'];
            $group = $service->getByID($id);
            if($group['USERS_IDUSERS'] != $userID){
                array_push($groups, $group);
            }
        }
        
        $connection = null;
        
        Log::info("Exiting AffinityMemberService.getAllJoined()");
        
        return $groups;
    }
    
    public function getAllMembers($groupID){
        
        Log::info("Entering AffinityMemberService.getAllMembers()");
        
        $connection = new Connection();
        
        $DAO = new AffinityMemberDAO($connection);
        
        $results = $DAO->getAllMembers($groupID);
        
        $connection = null;
        
        Log::info("Exiting AffinityMemberService.getAllMembers()");
        
        return $results;
    }
    
    public function joinGroup(int $userID, int $groupID){
        
        Log::info("Entering AffinityMemberService.joinGroup()");
        
        $connection = new Connection();
        
        $DAO = new AffinityMemberDAO($connection);
        
        $results = $DAO->create($groupID, $userID);
        
        $connection = null;
        
        Log::info("Exiting AffinityMemberService.joinGroup()");
        
        return $results;
    }
    
    public function joinOnCreation($connection, int $userID, int $groupID){
        
        Log::info("Entering AffinityMemberService.joinOnCreation()");
        
        $DAO = new AffinityMemberDAO($connection);
        
        $results = $DAO->create($groupID, $userID);
        
        Log::info("Exiting AffinityMemberService.JoinOnCreation()");
        
        return $results;
    }
    
    public function leaveGroup(int $userID, int $groupID){
        
        Log::info("Entering AffinityMemberService.leaveGroup()");
        
        $connection = new Connection();
        
        $DAO = new AffinityMemberDAO($connection);
        
        $results = $DAO->delete($groupID, $userID);
        
        $connection = null;
        
        Log::info("Exiting AffinityMemberService.leaveGroup()");
        
        return $results;
    }
}