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
use App\Models\AffinityGroupModel;

class AffinityGroupDAO{
    
    //Stores the connection that all methods will user for executing their queries 
    private $conn;
    
    /*
     * Non-default constructor that sets the connection field that all methods will use to execute their queries
     */
    public function __construct($connection){
        $this->conn = $connection;
    }
    
    /*
     * Method for creating a new affinity group
     */
    public function create(AffinityGroupModel $group){
        
        Log::info("Entering AffinityGroupDAO.create()");
        
        //Gets information from the affinity group model
        $name = $group->getName();
        $description = $group->getDescription();
        $focus = $group->getFocus();
        $userID = $group->getUserID();
        
        try{
            $statement = $this->conn->prepare("INSERT INTO AFFINITYGROUPS (IDAFFINITYGROUPS, NAME, DESCRIPTION, FOCUS, USERS_IDUSERS) VALUES (NULL, :name, :description, :focus, :userID)");
            //Binds the information from the model to the sql statement
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
        
        //Returns the result of the query as well as the insert id
        return ['result' => $statement->rowCount(), 'insertID' => $this->conn->lastInsertID()];
    }
    
    /*
     * Method gets an affinity group from it's id
     */
    public function getByID(int $id){
        
        Log::info("Entering AffinityGroupDAO.getByID()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM AFFINITYGROUPS WHERE IDAFFINITYGROUPS = :id");
            //Binds the id to the sql query
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting AffinityGroupDAO.getByID()");
        
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    /*
     * Gets all the affinity groups from the database and returns them in an array
     */
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
        
        //Adds all of the groups retrieved from the database to an array for return
        while($group = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($groups, $group);
        }
        
        Log::info("Exiting AffinityGroupDAO.getAll()");
        
        return $groups;
    }
    
    /*
     * Gets all of the affinity groups that a user owns
     */
    public function getOwned($userID){
        
        Log::info("Entering AffinityGroupDAO.getOwned()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM AFFINITYGROUPS WHERE USERS_IDUSERS = :userID");
            //Binds the user's ID to the sql statement
            $statement->bindParam(':userID', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $groups = [];
        
        //Adds all of the owned affinity groups to an array for return
        while($group = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($groups, $group);
        }
        
        Log::info("Exiting AffinityGroupDAO.getOwned()");
        
        return $groups;
    }
    
    /*
     * Edits an existing affinity group
     */
    public function edit(AffinityGroupModel $group){
        
        Log::info("Entering AffinityGroupDAO.edit()");
        
        try{
            //Gets all of the necessary information from the model
            $id = $group->getId();
            $name = $group->getName();
            $description = $group->getDescription();
            $focus = $group->getFocus();
            
            $statement = $this->conn->prepare("UPDATE AFFINITYGROUPS SET NAME = :name, DESCRIPTION = :description, FOCUS = :focus WHERE IDAFFINITYGROUPS = :id");
            //Binds the information from the model to the sql statement
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
    
    /*
     * Deletes an affinity group from the database
     */
    public function delete(int $id){
        
        Log::info("Entering AffinityGroupDAO.delete()");
        
        try{
            $statement = $this->conn->prepare("DELETE FROM AFFINITYGROUPS WHERE IDAFFINITYGROUPS = :id");
            //Binds the affinity group's id to the sql statement
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