<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-3-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use PDO;
use App\Services\Utility\DatabaseException;

class AffinityMemberDAO{
    
    //Connection user for all queries
    private $conn;
    
    /*
     * Non-default constructor that sets the connection field
     */
    public function __construct($connection){
        $this->conn = $connection;
    }
    
    /*
     * Method gets the id of all the groups a user is a member of 
     */
    public function getAllGroups(int $id){
        
        Log::info("Entering AffinityMemberDAO.getAllGroups()");
        
        try{
            $statement = $this->conn->prepare("SELECT AFFINITYGROUPS_IDAFFINITYGROUPS FROM AFFINITYGROUPMEMBER WHERE USERS_IDUSERS = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $groups = [];
        
        //Adds all results to the groups array
        while($group = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($groups, $group);
        }
        
        Log::info("Exiting AffinityMemberDAO.getAllGroups()");
        
        return $groups;
    }
    
    /*
     * Method gets the id of all the members of a particular group
     */
    public function getAllMembers(int $id){
        
        Log::info("Entering AffinityMemberDAO.getAllMembers()");
        
        try{
            $statement = $this->conn->prepare("SELECT USERS_IDUSERS FROM AFFINITYGROUPMEMBER WHERE AFFINITYGROUPS_IDAFFINITYGROUPS = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $members = [];
        
        //Adds all of the results from the query to the members array ot be returned to the service
        while($member = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($members, $member);
        }
        
        Log::info("Exiting AffinityMemberDAO.getAllMembers()");
        
        return $members;
    }
    
    /*
     * Creates a new entry meaning that a user has joined an affinity group
     */
    public function create(int $groupID, int $userID){
        
        Log::info("Entering AffinityMemberDAO.create()");
        
        try{
            $statement = $this->conn->prepare("INSERT INTO AFFINITYGROUPMEMBER (AFFINITYGROUPS_IDAFFINITYGROUPS, USERS_IDUSERS) VALUES (:groupID, :userID)");
            $statement->bindParam(':groupID', $groupID);
            $statement->bindParam(':userID', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting AffinityMemberDAO.create()");
        
        return $statement->rowCount();
    }
    
    /*
     * Removes an entry from the table meaning that a particular user has left a particular affinity group
     */
    public function delete(int $groupID, int $userID){
        
        Log::info("Entering AffinityMemberDAO.delete()");
        
        try{
            $statement = $this->conn->prepare("DELETE FROM AFFINITYGROUPMEMBER WHERE USERS_IDUSERS = :userID AND AFFINITYGROUPS_IDAFFINITYGROUPS = :groupID");
            $statement->bindParam(':userID', $userID);
            $statement->bindParam(':groupID', $groupID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting AffinityMemberDAO.delete()");
        
        return $statement->rowCount();
    }
}