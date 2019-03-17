<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use App\Services\Utility\MyLogger;
use App\Services\Utility\Connection;
use App\Services\Data\JobDAO;

class SearchService{
    
    /**
     * Function allows for the user to search for a job
     * @param string $searchString The string that will be used to search through the database for matches
     * @return array An array containing all of the jobs that matched the user's search string in some way
     */
    public function JobSearch(string $searchString){
        
        MyLogger::getLogger()->info("Entering SearchService.JobSearch()", [$searchString]);
        
        //Creates connection to the database
        $connection = new Connection();
        
        //Creates instance of the appropriate DAO
        $DAO = new JobDAO($connection);
        
        //Calls the appropriate methods for searching through job descriptions and titles
        $descriptionResults = $DAO->findByDescription($searchString);
        $titleResults = $DAO->findByTitle($searchString);
        
        //Close connection to the database
        $connection = null;
        
        //An array to store all of the search results
        $allResults = [];
        
        //Pushes all of the results from the description search into the final results array
        foreach($descriptionResults as $job){
            array_push($allResults, $job);
        }
        
        //Pushes all of the title search results that weren't in the description results into the final results array
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