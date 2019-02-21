<?php

namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\Connection;
use App\Services\Data\EducationDAO;
use App\Models\EducationModel;

class EducationService{
    
    public function findByID(int $id){
        
        Log::info("Entering EducationService.findByID()");
        
        $connection = new Connection();
        
        $DAO = new EducationDAO($connection);
        
        $results = $DAO->getByID($id);
        
        $connection = null;
        
        Log::info("Exiting EducationService.findByID()");
        
        return $results;
    }
    
    public function getAll(){
        
        Log::info("Entering EducationService.getAll()");
        
        $connection = new Connection();
        
        $DAO = new EducationDAO($connection);
        
        $results = $DAO->getAll();
        
        $connection = null;
        
        Log::info("Exiting EducationService.getAll()");
        
        return $results;
    }
    
    public function create(EducationModel $education){
        
        Log::info("Entering EducationService.create()");
        
        $connection = new Connection();
        
        $DAO = new EducationDAO($connection);
        
        $results = $DAO->create($education);
        
        $connection = null;
        
        Log::info("Exiting EducationService.create()");
        
        return $results;
    }
    
    public function update(EducationModel $education){
        
        Log::info("Entering EducationService.update()");
        
        $connection = new Connection();
        
        $DAO = new EducationDAO($connection);
        
        $results = $DAO->update($education);
        
        $connection = null;
        
        Log::info("Exiting EducationService.update()");
        
        return $results;
    }
    
    public function remove(int $id){
        
        Log::info("Entering EducationService.remove()");
        
        $connection = new Connection();
        
        $DAO = new EducationDAO($connection);
        
        $results = $DAO->remove($id);
        
        $connection = null;
        
        Log::info("Exiting EducationService.remove()");
        
        return $results;
    }
}