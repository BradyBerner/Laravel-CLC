<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-3-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use App\Models\SkillModel;
use Illuminate\Support\Facades\Log;
use App\Services\Utility\Connection;
use App\Services\Data\SkillDAO;

class SkillService{
    
    //Takes in a user id and finds all the skills associated with the user
    public function findByID(int $userID){
        
        Log::info("Entering SkillService.findByID()");
        
        //Gets a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the data access object
        $DAO = new SkillDAO($connection);
        
        //Calls the appropriate dao method and stores the results
        $results = $DAO->findByID($userID);
        
        //Destroys the connection to the database
        $connection = null;
        
        Log::info("Exiting SkillService.findByID()");
        
        return $results;
    }
    
    //Takes in a skill model and attempts to create an entry in the database with the information contained in the model
    public function create(SkillModel $skill){
        
        Log::info("Entering SkillService.create()");
        
        //Gets a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the data access object
        $DAO = new SkillDAO($connection);
        
        //Calls the appropriate dao method and stores the results
        $results = $DAO->create($skill);
        
        //Destroys the connection to the database
        $connection = null;
        
        Log::info("Exiting SkillService.create()");
        
        return $results;
    }
    
    //Takes in a skill id and attempts to remove the associated database entry
    public function remove(int $id){
        
        Log::info("Entering SkillService.remove()");
        
        //Gets a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the data access object
        $DAO = new SkillDAO($connection);
        
        //Calls the appropriate dao method and stores the results
        $results = $DAO->remove($id);
        
        //Destroys the connection to the database
        $connection = null;
        
        Log::info("Exiting SkillService.remove()");
        
        return $results;
    }
}