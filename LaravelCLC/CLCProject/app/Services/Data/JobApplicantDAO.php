<?php

namespace App\Services\Data;

use App\Services\Utility\MyLogger;
use App\Services\Utility\DatabaseException;
use PDO;

class JobApplicantDAO{
    
    private $conn;
    
    public function __construct($connection){
        $this->conn = $connection;
    }
    
    public function getAllJobs(int $userID){
        
        MyLogger::getLogger()->info("Entering JobApplicantDAO.getAllJobs()", [$userID]);
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM JOBAPPLICANTS WHERE USERS_IDUSERS = :id");
            $statement->bindParam(':id', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $jobs = [];
        
        while($job = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($jobs, $job);
        }
        
        MyLogger::getLogger()->info("Exiting JobApplicantDAO.getAllJobs()");
        
        return $jobs;
    }
    
    public function create(int $jobID, int $userID){
        
        MyLogger::getLogger()->info("Entering JobApplicantDAO.create()");
        
        try{
            $statement = $this->conn->prepare("INSERT INTO JOBAPPLICANTS (JOBS_IDJOBS, USERS_IDUSERS) VALUES (:jobID, :userID)");
            $statement->bindParam(':jobID', $jobID);
            $statement->bindParam(':userID', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        MyLogger::getLogger()->info("Exiting JobApplicantDAO.create()");
        
        return $statement->rowCount();
    }
    
    public function delete(int $jobID, int $userID){
        
        MyLogger::getLogger()->info("Entering JobApplicantDAO.delete()");
        
        try{
            $statement = $this->conn->prepare("DELETE FROM JOBAPPLICANTS WHERE JOBS_IDJOBS = :jobID AND USERS_IDUSERS = :userID");
            $statement->bindParam(':jobID', $jobID);
            $statement->bindParam(':userID', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        MyLogger::getLogger()->info("Exiting JobApplicantDAO.delete()");
        
        return $statement->rowCount();
    }
}