<?php

namespace App\Services\Business;

use App\Services\Utility\MyLogger;
use App\Services\Utility\Connection;
use App\Services\Data\JobApplicantDAO;

class JobApplicantService {
    
    public function getAllJobs($userID){
        
        MyLogger::getLogger()->info("Entering JobApplicantService.getAllJobs()", [$userID]);
        
        $connection = new Connection();
        
        $DAO = new JobApplicantDAO($connection);
        
        $results = $DAO->getAllJobs($userID);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting JobApplicantService.getAllJobs()");
        
        return $results;
    }
    
    public function getAllApplicants($jobID){
        
        MyLogger::getLogger()->info("Entering JobApplicantService.getAllApplicants()", [$jobID]);
        
        $connection = new Connection();
        
        $DAO = new JobApplicantDAO($connection);
        
        $results = $DAO->getAllApplicants($jobID);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting JobApplicantService.getAllApplicants()");
        
        return $results;
    }
    
    public function apply($jobID, $userID){
        
        MyLogger::getLogger()->info("Entering JobApplicantService.apply()", ['jobID' => $jobID, 'userID' => $userID]);
        
        $connection = new Connection();
        
        $DAO = new JobApplicantDAO($connection);
        
        $results = $DAO->create($jobID, $userID);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting JobApplicantService.apply()", [$results]);
        
        return $results;
    }
    
    public function cancelApplication($jobID, $userID){
        
        MyLogger::getLogger()->info("Entering JobApplicantService.cancelApplication()", ['jobID' => $jobID, 'userID' => $userID]);
        
        $connection = new Connection();
        
        $DAO = new JobApplicantDAO($connection);
        
        $results = $DAO->delete($jobID, $userID);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting JobApplicantService.cancelApplication()", [$results]);
        
        return $results;
    }
}