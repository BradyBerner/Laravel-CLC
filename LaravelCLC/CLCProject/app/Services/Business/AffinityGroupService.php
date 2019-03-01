<?php

namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use PDO;
use App\Services\Utility\Connection;
use App\Services\Data\AffinityGroupDAO;
use App\Models\AffinityGroupModel;
use App\Services\Utility\DatabaseException;

class AffinityGroupService{
    
    public function getByID(int $id){
        
        Log::info("Entering AffinityGroupService.getByID()");
        
        $connection = new Connection();
        
        $DAO = new AffinityGroupDAO($connection);
        
        $results = $DAO->getByID($id);
        
        $connection = null;
        
        Log::info("Exiting AffinityGroupService.getByID()");
        
        return $results;
    }
    
    public function getAllOwned($userID){
        
        Log::info("Entering AffinityGroupService.getAllOwned()");
        
        $connection = new Connection();
        
        $DAO = new AffinityGroupDAO($connection);
        
        $results = $DAO->getOwned($userID);
        
        $connection = null;
        
        Log::info("Exiting AffinityGroupService.getAllOwned()");
        
        return $results;
    }
    
    public function getAll(){
        
        Log::info("Entering AffinityGroupService.getAll()");
        
        $connection = new Connection();
        
        $DAO = new AffinityGroupDAO($connection);
        
        $results = $DAO->getAll();
        
        $connection = null;
        
        Log::info("Exiting AffinityGroupService.getAll()");
        
        return $results;
    }
    
    public function createGroup(AffinityGroupModel $group){
        
        Log::info("Entering AffinityGroupService.createGroup()");
        
        try{
        $connection = new Connection();
        $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
        $connection->beginTransaction();
        
        $DAO = new AffinityGroupDAO($connection);
        
        $results = $DAO->create($group);
        
        if($results['result']){
            $memberService = new AffinityMemberService();
            
            $joinResults = $memberService->joinOnCreation($connection, $group->getUserID(), $results['insertID']);
            
            if($joinResults){
                $connection->commit();
            } else {
                $connection->rollBack();
            }
        }
        
        $connection = null;
        } catch (\Exception $e){
            Log::error("Database exception: ", $e->getMessage());
            $connection->rollBack();
            throw new DatabaseException("Exception: " . $e->getMessage(), $e, 0);
        }
        
        Log::info("Exiting AffinityGroupService.createGroup()");
        
        return $results['result'];
    }
    
    public function editGroup(AffinityGroupModel $group){
        
        Log::info("Entering AffinityGroupService.editGroup()");

        $connection = new Connection();
           
        $DAO = new AffinityGroupDAO($connection);
            
        $results = $DAO->edit($group);
        
        $connection = null;
            
        Log::info("Exiting AffinityGroupService.editGroup()");
            
        return $results;
    }
    
    public function deleteGroup(int $id){
        
        Log::info("Entering AffinityGroupService.deleteGroup()");
        
        $connection = new Connection();
        
        $DAO = new AffinityGroupDAO($connection);
        
        $results = $DAO->delete($id);
        
        $connection = null;
        
        Log::info("Exiting AffinityGroupService.deleteGroup()");
        
        return $results;
    }
}