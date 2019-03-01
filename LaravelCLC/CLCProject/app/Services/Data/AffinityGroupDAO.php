<?php

namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use PDO;
use App\Services\Utility\DatabaseException;
use App\Models\AffinityGroupModel;

class AffinityGroupDAO{
    
    private $conn;
    
    public function __construct($connection){
        $this->conn = $connection;
    }
    
    public function create(AffinityGroupModel $group){
        
        Log::info("Entering AffinityGroupDAO.create()");
        
        $name = $group->getName();
        $description = $group->getDescription();
        $focus = $group->getFocus();
        $userID = $group->getUserID();
        
        try{
            $statement = $this->conn->prepare("INSERT INTO AFFINITYGROUPS (IDAFFINITYGROUPS, NAME, DESCRIPTION, FOCUS, USERS_IDUSERS) VALUES (NULL, :name, :description, :focus, :userID)");
            $statement->bindParam(':name', $name);
            $statement->bindParam(':description', $description);
            $statement->bindParam('focus', $focus);
            $statement->bindParam('userID', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting AffinityGroupDAO.create()");
        
        return ['result' => $statement->rowCount(), 'insertID' => $this->conn->lastInsertID()];
    }
    
    public function getByID(int $id){
        
        Log::info("Entering AffinityGroupDAO.getByID()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM AFFINITYGROUPS WHERE IDAFFINITYGROUPS = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting AffinityGroupDAO.getByID()");
        
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getAll(){
        
        Log::info("Entering AffinityGroupDAO.getAll()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM AFFINITYGROUPS");
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $groups = [];
        
        while($group = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($groups, $group);
        }
        
        Log::info("Exiting AffinityGroupDAO.getAll()");
        
        return $groups;
    }
    
    public function getOwned($userID){
        
        Log::info("Entering AffinityGroupDAO.getOwned()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM AFFINITYGROUPS WHERE USERS_IDUSERS = :userID");
            $statement->bindParam(':userID', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $groups = [];
        
        while($group = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($groups, $group);
        }
        
        Log::info("Exiting AffinityGroupDAO.getOwned()");
        
        return $groups;
    }
    
    public function edit(AffinityGroupModel $group){
        
        Log::info("Entering AffinityGroupDAO.edit()");
        
        try{
            $id = $group->getId();
            $name = $group->getName();
            $description = $group->getDescription();
            $focus = $group->getFocus();
            
            $statement = $this->conn->prepare("UPDATE AFFINITYGROUPS SET NAME = :name, DESCRIPTION = :description, FOCUS = :focus WHERE IDAFFINITYGROUPS = :id");
            $statement->bindParam(':name', $name);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':focus', $focus);
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting AffinityGroupDAO.edit()");
        
        return $statement->rowCount();
    }
    
    public function delete(int $id){
        
        Log::info("Entering AffinityGroupDAO.delete()");
        
        try{
            $statement = $this->conn->prepare("DELETE FROM AFFINITYGROUPS WHERE IDAFFINITYGROUPS = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting AffinityGroupDAO.delete()");
        
        return $statement->rowCount();
    }
}