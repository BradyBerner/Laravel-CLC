<?php

namespace App\Services\Business;

use App\Models\SkillModel;
use Illuminate\Support\Facades\Log;
use App\Services\Utility\Connection;
use App\Services\Data\SkillDAO;

class SkillService{
    
    public function findByID(int $userID){
        
        Log::info("Entering SkillService.findByID()");
        
        $connection = new Connection();
        
        $DAO = new SkillDAO($connection);
        
        $results = $DAO->findByID($userID);
        
        $connection = null;
        
        Log::info("Exiting SkillService.findByID()");
        
        return $results;
    }
    
    public function create(SkillModel $skill){
        
        Log::info("Entering SkillService.create()");
        
        $connection = new Connection();
        
        $DAO = new SkillDAO($connection);
        
        $results = $DAO->create($skill);
        
        $connection = null;
        
        Log::info("Exiting SkillService.create()");
        
        return $results;
    }
    
    public function remove(int $id){
        
        Log::info("Entering SkillService.remove()");
        
        $connection = new Connection();
        
        $DAO = new SkillDAO($connection);
        
        $results = $DAO->remove($id);
        
        $connection = null;
        
        Log::info("Exiting SkillService.remove()");
        
        return $results;
    }
}