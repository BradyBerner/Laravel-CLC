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
use App\Services\Data\JobApplicantDAO;

class JobApplicantService {
    
    /**
     * Gets all of the jobs that a user has applied to
     * @param int $userID The ID of the user to get the applied jobs from
     * @return array An array containing all of the jobs a user has applied to
     */
    public function getAllJobs($userID){
        
        MyLogger::getLogger()->info("Entering JobApplicantService.getAllJobs()", [$userID]);
        
        //Creates a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the DAO 
        $DAO = new JobApplicantDAO($connection);
        
        //Stores results from the DAO function call
        $results = $DAO->getAllJobs($userID);
        
        //Closes connection to the database
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting JobApplicantService.getAllJobs()");
        
        return $results;
    }
    
    public function getAllApplicants($jobID){
        
        MyLogger::getLogger()->info("Entering JobApplicantService.getAllApplicants()", [$jobID]);
        
        //Creates a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the DAO
        $DAO = new JobApplicantDAO($connection);
        
        //Stores the results from the DAO function call
        $results = $DAO->getAllApplicants($jobID);
        
        //Closes the connection to the database
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting JobApplicantService.getAllApplicants()");
        
        return $results;
    }
    
    /**
     * Allows the user to apply to a job
     * @param int $jobID The ID of the job the user is applying to
     * @param int $userID The ID of the user that is applying for a job
     * @return boolean The result of the user's attempt to apply to the job
     */
    public function apply($jobID, $userID){
        
        MyLogger::getLogger()->info("Entering JobApplicantService.apply()", ['jobID' => $jobID, 'userID' => $userID]);
        
        //Creates a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the DAO
        $DAO = new JobApplicantDAO($connection);
        
        //Stores the results of the DAO function call
        $results = $DAO->create($jobID, $userID);
        
        //Closes the connection to the database
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting JobApplicantService.apply()", [$results]);
        
        return $results;
    }
    
    /**
     * Allows the user to delete the application they've submitted to a job
     * @param int $jobID The ID of the job the user applied to
     * @param int $userID The ID of the user whose application should be removed
     * @return boolean The result of the attempted removal
     */
    public function cancelApplication($jobID, $userID){
        
        MyLogger::getLogger()->info("Entering JobApplicantService.cancelApplication()", ['jobID' => $jobID, 'userID' => $userID]);
        
        //Creates a connection to the database
        $connection = new Connection();
        
        //Creates an instance of the DAO
        $DAO = new JobApplicantDAO($connection);
        
        //Stores the results of the DAO function call
        $results = $DAO->delete($jobID, $userID);
        
        //Closes the connection to the database
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting JobApplicantService.cancelApplication()", [$results]);
        
        return $results;
    }
}