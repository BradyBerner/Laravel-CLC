<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Data;

use App\Models\JobModel;

use App\Services\Utility\DatabaseException;
use App\Services\Utility\MyLogger;
use PDO;

class JobDAO{
    
    //Stores the connection that functions will use to access the database
    private $conn;
    
    //Takes in a PDO connection and sets the conn field equal to it
    public function __construct($conn){
        $this->conn = $conn;
    }
    
    /**
     * Gets a job based off the ID passed to the function
     * @param int $id The ID of the job to be retrieved from the database
     * @throws DatabaseException 
     * @return array An associative array containing all of the values from the job retrieved
     */
    public function getByID(int $id){
        MyLogger::getLogger()->info("Entering JobDAO.getByID()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM JOBS WHERE IDJOBS = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        MyLogger::getLogger()->info("Exit JobDAO.getByID()");
        
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    
    //Returns an array of all the jobs in the database in the form of associative arrays
    public function getAll(){
        MyLogger::getLogger()->info("Entering JobDAO.getAll()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM JOBS");
            $statement->execute();
        } catch (\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        //Temporary array to hold all job data
        $jobs = [];
        
        //Iterates over each job gotten back from the database query
        while($job = $statement->fetch(PDO::FETCH_ASSOC)){
            //Adds the associative array representing the currently iterated job to the jobs array
            array_push($jobs, $job);
        }
        
        MyLogger::getLogger()->info("Exit JobDAO.getAll()");
        
        //Returns the completed jobs array containing all of the job associative arrays
        return $jobs;
    }
    
    //Takes in a userID and returns an associative array containing all the jobs associated with that user
    public function findByID(int $id){
        MyLogger::getLogger()->info("Entering JobDAO.findByID()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM JOBS WHERE IDJOBS = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        MyLogger::getLogger()->info("Exiting JobDAO.findByID()");
        //Returns whether or not the query found anything and the user in the event that it did
        return ['result' => $statement->rowCount(), 'job' => $statement->fetch(PDO::FETCH_ASSOC)];
    }
    
    /**
     * Gets all of the jobs with titles linked to the search string
     * @param string $title The search string that will be used for the query
     * @throws DatabaseException
     * @return array An array of all the jobs that are linked to the search string
     */
    public function findByTitle(string $title){
        
        MyLogger::getLogger()->info("Entering JobDAO.findByName()", [$title]);
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM JOBS WHERE TITLE LIKE :search");
            $statement->bindParam(':search', $title);
            $statement->execute();
        } catch (\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $jobs = [];
        
        while($job = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($jobs, $job);
        }
        
        MyLogger::getLogger()->info("Exiting JobDAO.findByTitle()");
        
        return $jobs;
    }
    
    /**
     * Gets all of the jobs with descriptions linked to the search string
     * @param string $description The search string that will be used for the query
     * @throws DatabaseException
     * @return array An array of all the jobs that are linked to the search string
     */
    public function findByDescription(string $description){
        
        MyLogger::getLogger()->info("Entering JobDAO.findByDescription()", [$description]);
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM JOBS WHERE DESCRIPTION LIKE :search");
            $statement->bindParam(':search', $description);
            $statement->execute();
        } catch (\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $jobs = [];
        
        while($job = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($jobs, $job);
        }
        
        MyLogger::getLogger()->info("Exiting JobDAO.findByDescription()");
        
        return $jobs;
    }
    
    //Takes in a jobModel and uses it to create a new job in the database
    public function create(JobModel $job){
        MyLogger::getLogger()->info("Entering JobDAO.newJob()");
        
        try{
            //Gets all of the information from the jobModel passed as an argument
            $title = $job->getTitle();
            $company = $job->getCompany();
            $state = $job->getState();
            $city = $job->getCity();
            $description = $job->getDescription();
            
            //Statement to create new entry in the users table with passed information and a NULL primary key and default values for the role and status
            $statement = $this->conn->prepare("INSERT INTO `JOBS` (`IDJOBS`, `TITLE`, `COMPANY`, `STATE`, `CITY`, `DESCRIPTION`) VALUES (NULL, :title, :company, :state, :city, :description)");
            //Binds all of the usermodel information to their respective tokens
            $statement->bindParam(':title', $title);
            $statement->bindParam(':company', $company);
            $statement->bindParam(':state', $state);
            $statement->bindParam(':city', $city);
            $statement->bindParam(':description', $description);
            $statement->execute();
        } catch (\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        MyLogger::getLogger()->info("Exit JobDAO.newJob()");
        //Returns the result of the database query as well as the ID of the created user
        return ['result' => $statement->rowCount(), 'insertID' => $this->conn->lastInsertID()];
    }
    
    //Takes a jobModel as an argument and updates the job's database entry with the information passed
    public function update(JobModel $job){
        MyLogger::getLogger()->info("Entering JobDAO.update()");
        
        try{
            //Gets all of the information from the jobModel
            $id = $job->getId();
            $title = $job->getTitle();
            $company = $job->getCompany();
            $state = $job->getState();
            $city = $job->getCity();
            $description = $job->getDescription();
           
            
            $statement = $this->conn->prepare("UPDATE `JOBS` SET `TITLE` = :title, `COMPANY` = :company, `STATE` = :state, `CITY` = :city, `DESCRIPTION` = :description WHERE `IDJOBS` = :id");
            //Binds all of the information from the jobModel to their respective query tokens
            $statement->bindParam(':title', $title);
            $statement->bindParam(':company', $company);
            $statement->bindParam(':state', $state);
            $statement->bindParam(':city', $city);
            $statement->bindParam(':description', $description);
            
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        MyLogger::getLogger()->info("Exit JobDAO.update()");
        //Returns the result of the query
        return $statement->rowCount();
    }
    
    //Takes in an ID as an argument and attempts to delete the job
    public function remove($id){
        MyLogger::getLogger()->info("Entering JobDAO.remove()");
        
        try{            
            $statement = $this->conn->prepare("DELETE FROM `JOBS` WHERE `IDJOBS` = :id");
            //Binds the ID passed as an argument to the query
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        MyLogger::getLogger()->info("Exit JobDAO.remove()");
        //Returns the result of the query
        return $statement->rowCount();
    }
}