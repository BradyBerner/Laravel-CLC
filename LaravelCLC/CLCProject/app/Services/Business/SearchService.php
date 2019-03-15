<?php

namespace App\Services\Business;

use App\Services\Utility\MyLogger;
use App\Services\Utility\Connection;
use App\Services\Data\JobDAO;

class SearchService{
    
    public function JobSearch(string $searchString){
        
        MyLogger::getLogger()->info("Entering SearchService.JobSearch()", [$searchString]);
        
        $connection = new Connection();
        
        $DAO = new JobDAO($connection);
        
        $descriptionResults = $DAO->findByDescription($searchString);
        $titleResults = $DAO->findByTitle($searchString);
        
        $connection = null;
        
        $allResults = [];
        
        foreach($descriptionResults as $job){
            array_push($allResults, $job);
        }
        
        foreach($titleResults as $job){
            $add = true;
            foreach($allResults as $added){
                if($job['IDJOBS'] == $added['IDJOBS']){
                    $add = false;
                }
            }
            if($add){
                array_push($allResults, $job);
            }
        }
        
        MyLogger::getLogger()->info("Exiting SearchService.JobSearch()");
        
        return $allResults;
    }
}