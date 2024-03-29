<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use App\Services\Utility\ILoggerService;
use Exception;
use PDO;
use App\Services\Utility\Connection;
use App\Services\Data\AffinityGroupDAO;
use App\Models\AffinityGroupModel;
use App\Services\Utility\DatabaseException;

/**
 * Class AffinityGroupService
 * @package App\Services\Business
 */
class AffinityGroupService{
    
    /*
     * Gets an affinity group with a particular id
     */
    /**
     * @param int $id
     * @param ILoggerService $logger
     * @return array
     * @throws DatabaseException
     */
    public function getByID($id, ILoggerService $logger){
        
        $logger->info("Entering AffinityGroupService.getByID()", []);
        
        //Creates a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the dao
        $DAO = new AffinityGroupDAO($connection, $logger);
        
        //Stores the results of the dao method call
        $results = $DAO->getByID($id);
        
        $connection = null;
        
        $logger->info("Exiting AffinityGroupService.getByID()", []);
        
        return $results;
    }
    
    /*
     * Gets all of the affinity groups that a particular user owns
     */
    /**
     * @param $userID
     * @param ILoggerService $logger
     * @return array
     * @throws DatabaseException
     */
    public function getAllOwned($userID, ILoggerService $logger){
        
        $logger->info("Entering AffinityGroupService.getAllOwned()", []);
        
        //Creates a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the dao
        $DAO = new AffinityGroupDAO($connection, $logger);
        
        //Stores the results of the dao method call
        $results = $DAO->getOwned($userID);
        
        $connection = null;
        
        $logger->info("Exiting AffinityGroupService.getAllOwned()", []);
        
        return $results;
    }
    
    /*
     * Gets all of the affinity groups in the database
     */
    /**
     * @param ILoggerService $logger
     * @return array
     * @throws DatabaseException
     */
    public function getAll(ILoggerService $logger){
        
        $logger->info("Entering AffinityGroupService.getAll()", []);
        
        //Creates a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the dao
        $DAO = new AffinityGroupDAO($connection, $logger);
        
        //Stores the results of the dao method call
        $results = $DAO->getAll();
        
        $connection = null;
        
        $logger->info("Exiting AffinityGroupService.getAll()", []);
        
        return $results;
    }
    
    /*
     * Creates a new group entry in the database
     */
    /**
     * @param AffinityGroupModel $group
     * @param ILoggerService $logger
     * @return mixed
     * @throws DatabaseException
     */
    public function createGroup(AffinityGroupModel $group, ILoggerService $logger){
        
        $logger->info("Entering AffinityGroupService.createGroup()", []);
        
        try{
        //Creates a connection to the database
        $connection = new Connection();
        //Turns off auto-commit on this instance of the connection
        $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
        //Begins a transaction
        $connection->beginTransaction();
        
        //Creates an instance of the group dao
        $DAO = new AffinityGroupDAO($connection, $logger);
        
        //Gets the result of the group dao method call
        $results = $DAO->create($group);
        
        //If the dao method succeded continue the transaction
        if($results['result']){
            //Create an instance of the member service
            $memberService = new AffinityMemberService();
            
            //Stores the results of the member service method call using the non-auto-commit connection
            $joinResults = $memberService->joinOnCreation($connection, $group->getUserID(), $results['insertID'], $logger);
            
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
        
        } catch (Exception $e){
            $logger->error("Database exception: ", $e->getMessage());
            $connection->rollBack();
            throw new DatabaseException("Exception: " . $e->getMessage(), 0, $e);
        }
        
        $logger->info("Exiting AffinityGroupService.createGroup()", []);
        
        return $results['result'];
    }
    
    /*
     * Method for editing an existing group in the database
     */
    /**
     * @param AffinityGroupModel $group
     * @param ILoggerService $logger
     * @return int
     * @throws DatabaseException
     */
    public function editGroup(AffinityGroupModel $group, ILoggerService $logger){
        
        $logger->info("Entering AffinityGroupService.editGroup()", []);

        //Get a connection to the database
        $connection = new Connection();
           
        //Create an instance of the dao
        $DAO = new AffinityGroupDAO($connection, $logger);
            
        //Store the results of the dao method call
        $results = $DAO->edit($group);
        
        $connection = null;
            
        $logger->info("Exiting AffinityGroupService.editGroup()", []);
            
        return $results;
    }
    
    /*
     * Method for deleting an existing group in the database
     */
    /**
     * @param $id
     * @param ILoggerService $logger
     * @return int
     * @throws DatabaseException
     */
    public function deleteGroup($id, ILoggerService $logger){
        
        $logger->info("Entering AffinityGroupService.deleteGroup()", []);
        
        //Get a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the dao
        $DAO = new AffinityGroupDAO($connection, $logger);
        
        //Store the results of the dao method call
        $results = $DAO->delete($id);
        
        $connection = null;
        
        $logger->info("Exiting AffinityGroupService.deleteGroup()", []);
        
        return $results;
    }
}