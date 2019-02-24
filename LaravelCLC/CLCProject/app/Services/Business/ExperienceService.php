<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 2-24-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\Connection;
use App\Services\Data\ExperienceDAO;
use App\Models\ExperienceModel;

class ExperienceService{
    
    public function findByID(int $id){
        
        Log::info("Entering ExperienceService.findByID()");
        
        //Gets a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the data access object
        $DAO = new ExperienceDAO($connection);
        
        //Calls the appropriate dao function and stores the results
        $results = $DAO->getByID($id);
        
        //Destroys the connection to the database
        $connection = null;
        
        Log::info("Exiting ExperienceService.findByID()");
        
        return $results;
    }
    
    public function getAll(){
        
        Log::info("Entering ExperienceService.getAll()");
        
        //Gets a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the data access object
        $DAO = new ExperienceDAO($connection);
        
        //Calls the appropriate dao function and stores the results
        $results = $DAO->getAll();
        
        //Destroys the connection to the database
        $connection = null;
        
        Log::info("Exiting ExperienceService.getAll()");
        
        return $results;
    }
    
    public function create(ExperienceModel $experience){
        
        Log::info("Entering ExperienceService.create()");
        
        //Gets a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the data access object
        $DAO = new ExperienceDAO($connection);
        
        //Calls the appropriate dao function and stores the results
        $results = $DAO->create($experience);
        
        //Destroys the connection to the database
        $connection = null;
        
        Log::info("Exiting ExperienceService.create()");
        
        return $results;
    }
    
    public function update(ExperienceModel $experience){
        
        Log::info("Entering ExperienceService.update()");
        
        //Gets a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the data access object
        $DAO = new ExperienceDAO($connection);
        
        //Calls the appropriate dao function and stores the results
        $results = $DAO->update($experience);
        
        //Destroys the connection to the database
        $connection = null;
        
        Log::info("Exiting ExperienceService.update()");
        
        return $results;
    }
    
    public function remove(int $id){
        
        Log::info("Entering ExperienceService.remove()");
        
        //Gets a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the data access object
        $DAO = new ExperienceDAO($connection);
        
        //Calls the appropriate dao function and stores the results
        $results = $DAO->remove($id);
        
        //Destroys the connection to the database
        $connection = null;
        
        Log::info("Exiting ExperienceService.remove()");
        
        return $results;
    }
}