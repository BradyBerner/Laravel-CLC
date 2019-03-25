<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use App\Services\Utility\Connection;
use App\Services\Utility\MyLogger;
use App\Services\Data\AffinityMemberDAO;

class AffinityMemberService{
    
    /*
     * Method to get all of the affinity groups that a user has joined from the database
     */
    public function getAllJoined($userID){
        
        MyLogger::getLogger()->info("Entering AffinityMemberService.getAllJoined()");
        
        //Creates connection
        $connection = new Connection();
        
        //Creates instance of the dao
        $DAO = new AffinityMemberDAO($connection);
        
        //Gets the results from the proper dao method
        $results = $DAO->getAllGroups($userID);
        
        $groups = [];
        $service = new AffinityGroupService();
        
        //Adds all of the affinity groups that a user does not own to the groups array
        foreach($results as $result){
            $id = $result['AFFINITYGROUPS_IDAFFINITYGROUPS'];
            $group = $service->getByID($id)['group'];
            if($group['USERS_IDUSERS'] != $userID){
                array_push($groups, $group);
            }
        }
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting AffinityMemberService.getAllJoined()");
        
        return $groups;
    }
    
    /*
     * Method for getting all of the members of an affinity group
     */
    public function getAllMembers($groupID){
        
        MyLogger::getLogger()->info("Entering AffinityMemberService.getAllMembers()");
        
        //Creates a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the dao
        $DAO = new AffinityMemberDAO($connection);
        
        //Gets the results from the dao method
        $results = $DAO->getAllMembers($groupID);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting AffinityMemberService.getAllMembers()");
        
        return $results;
    }
    
    /*
     * Lets a user join a particular affinity group
     */
    public function joinGroup(int $userID, int $groupID){
        
        MyLogger::getLogger()->info("Entering AffinityMemberService.joinGroup()");
        
        //Creates connection to the database
        $connection = new Connection();
        
        //Creates an instance of the dao 
        $DAO = new AffinityMemberDAO($connection);
        
        //Gets the result of the dao method
        $results = $DAO->create($groupID, $userID);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting AffinityMemberService.joinGroup()");
        
        return $results;
    }
    
    /*
     * Method that forces a user that just created an affinity group to join the affinity 
     * group they just created
     */
    public function joinOnCreation($connection, int $userID, int $groupID){
        
        MyLogger::getLogger()->info("Entering AffinityMemberService.joinOnCreation()");
        
        //Creates instance of dao using the connection passed to the method
        $DAO = new AffinityMemberDAO($connection);
        
        //Gets the results of the dao method call
        $results = $DAO->create($groupID, $userID);
        
        MyLogger::getLogger()->info("Exiting AffinityMemberService.JoinOnCreation()");
        
        return $results;
    }
    
    /*
     * Lets a user leave an affinity group that they've joined
     */
    public function leaveGroup(int $userID, int $groupID){
        
        MyLogger::getLogger()->info("Entering AffinityMemberService.leaveGroup()");
        
        //Creates a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the dao
        $DAO = new AffinityMemberDAO($connection);
        
        //Gets the results of the dao method call
        $results = $DAO->delete($groupID, $userID);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting AffinityMemberService.leaveGroup()");
        
        return $results;
    }
}