<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use PDO;
use App\Services\Utility\Connection;
use App\Services\Utility\MyLogger;
use App\Services\Data\AffinityGroupDAO;
use App\Models\AffinityGroupModel;
use App\Services\Utility\DatabaseException;

class AffinityGroupService{
    
    /*
     * Gets an affinity group with a particular id
     */
    public function getByID(int $id){
        
        MyLogger::getLogger()->info("Entering AffinityGroupService.getByID()");
        
        //Creates a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the dao
        $DAO = new AffinityGroupDAO($connection);
        
        //Stores the results of the dao method call
        $results = $DAO->getByID($id);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting AffinityGroupService.getByID()");
        
        return $results;
    }
    
    /*
     * Gets all of the affinity groups that a particular user owns
     */
    public function getAllOwned($userID){
        
        MyLogger::getLogger()->info("Entering AffinityGroupService.getAllOwned()");
        
        //Creates a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the dao
        $DAO = new AffinityGroupDAO($connection);
        
        //Stores the results of the dao method call
        $results = $DAO->getOwned($userID);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting AffinityGroupService.getAllOwned()");
        
        return $results;
    }
    
    /*
     * Gets all of the affinity groups in the database
     */
    public function getAll(){
        
        MyLogger::getLogger()->info("Entering AffinityGroupService.getAll()");
        
        //Creates a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the dao
        $DAO = new AffinityGroupDAO($connection);
        
        //Stores the results of the dao method call
        $results = $DAO->getAll();
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting AffinityGroupService.getAll()");
        
        return $results;
    }
    
    /*
     * Creates a new group entry in the database
     */
    public function createGroup(AffinityGroupModel $group){
        
        MyLogger::getLogger()->info("Entering AffinityGroupService.createGroup()");
        
        try{
        //Creates a connection to the database
        $connection = new Connection();
        //Turns off auto-commit on this instance of the connection
        $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
        //Begins a transaction
        $connection->beginTransaction();
        
        //Creates an instance of the group dao
        $DAO = new AffinityGroupDAO($connection);
        
        //Gets the result of the group dao method call
        $results = $DAO->create($group);
        
        //If the dao method succeded continue the transaction
        if($results['result']){
            //Create an instance of the member service
            $memberService = new AffinityMemberService();
            
            //Stores the results of the member service method call using the non-auto-commit connection
            $joinResults = $memberService->joinOnCreation($connection, $group->getUserID(), $results['insertID']);
            
            //Checks to make sure that the member service method succeded
            if($joinResults){
                //Commite the connection if everything worked
                $connection->commit();
            } else {
                //Rollback the connection if the member service method failed
                $connection->rollBack();
            }
        }
        
        $connection = null;
        
        } catch (\Exception $e){
            MyLogger::getLogger()->error("Database exception: ", $e->getMessage());
            $connection->rollBack();
            throw new DatabaseException("Exception: " . $e->getMessage(), $e, 0);
        }
        
        MyLogger::getLogger()->info("Exiting AffinityGroupService.createGroup()");
        
        return $results['result'];
    }
    
    /*
     * Method for editing an existing group in the database
     */
    public function editGroup(AffinityGroupModel $group){
        
        MyLogger::getLogger()->info("Entering AffinityGroupService.editGroup()");

        //Get a connection to the database
        $connection = new Connection();
           
        //Create an instance of the dao
        $DAO = new AffinityGroupDAO($connection);
            
        //Store the results of the dao method call
        $results = $DAO->edit($group);
        
        $connection = null;
            
        MyLogger::getLogger()->info("Exiting AffinityGroupService.editGroup()");
            
        return $results;
    }
    
    /*
     * Method for deleting an existing group in the database
     */
    public function deleteGroup(int $id){
        
        MyLogger::getLogger()->info("Entering AffinityGroupService.deleteGroup()");
        
        //Get a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the dao
        $DAO = new AffinityGroupDAO($connection);
        
        //Store the results of the dao method call
        $results = $DAO->delete($id);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting AffinityGroupService.deleteGroup()");
        
        return $results;
    }
}