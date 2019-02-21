<?php

namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\Connection;
use App\Services\Data\ExperienceDAO;
use App\Models\ExperienceModel;

class ExperienceService{
    
    public function findByID(int $id){
        
        Log::info("Entering ExperienceService.findByID()");
        
        $connection = new Connection();
        
        $DAO = new ExperienceDAO($connection);
        
        $results = $DAO->getByID($id);
        
        $connection = null;
        
        Log::info("Exiting ExperienceService.findByID()");
        
        return $results;
    }
    
    public function getAll(){
        
        Log::info("Entering ExperienceService.getAll()");
        
        $connection = new Connection();
        
        $DAO = new ExperienceDAO($connection);
        
        $results = $DAO->getAll();
        
        $connection = null;
        
        Log::info("Exiting ExperienceService.getAll()");
        
        return $results;
    }
    
    public function create(ExperienceModel $experience){
        
        Log::info("Entering ExperienceService.create()");
        
        $connection = new Connection();
        
        $DAO = new ExperienceDAO($connection);
        
        $results = $DAO->create($experience);
        
        $connection = null;
        
        Log::info("Exiting ExperienceService.create()");
        
        return $results;
    }
    
    public function update(ExperienceModel $experience){
        
        Log::info("Entering ExperienceService.update()");
        
        $connection = new Connection();
        
        $DAO = new ExperienceDAO($connection);
        
        $results = $DAO->update($experience);
        
        $connection = null;
        
        Log::info("Exiting ExperienceService.update()");
        
        return $results;
    }
    
    public function remove(int $id){
        
        Log::info("Entering ExperienceService.remove()");
        
        $connection = new Connection();
        
        $DAO = new ExperienceDAO($connection);
        
        $results = $DAO->remove($id);
        
        $connection = null;
        
        Log::info("Exiting ExperienceService.remove()");
        
        return $results;
    }
}