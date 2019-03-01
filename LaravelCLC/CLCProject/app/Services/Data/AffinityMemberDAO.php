<?php

namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use PDO;
use App\Services\Utility\DatabaseException;

class AffinityMemberDAO{
    
    private $conn;
    
    public function __construct($connection){
        $this->conn = $connection;
    }
    
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
        
        while($group = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($groups, $group);
        }
        
        Log::info("Exiting AffinityMemberDAO.getAllGroups()");
        
        return $groups;
    }
    
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
        
        while($member = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($members, $member);
        }
        
        Log::info("Exiting AffinityMemberDAO.getAllMembers()");
        
        return $members;
    }
    
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