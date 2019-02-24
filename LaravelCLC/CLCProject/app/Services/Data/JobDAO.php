<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 2-10-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Data;

use App\Models\JobModel;

use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use PDO;

class JobDAO{
    
    //Stores the connection that functions will use to access the database
    private $conn;
    
    //Takes in a PDO connection and sets the conn field equal to it
    public function __construct($conn){
        $this->conn = $conn;
    }
    
    //Returns an array of all the users in the database in the form of associative arrays
    public function getAll(){
        Log::info("Entering JobDAO.getAll()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM JOBS");
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        //Temporary array to hold all user data
        $jobs = [];
        
        //Iterates over each user gotten back from the database query
        while($job = $statement->fetch(PDO::FETCH_ASSOC)){
            //Adds the associative array representing the currently iterated user to the users array
            array_push($jobs, $job);
        }
        
        Log::info("Exit JobDAO.getAll()");
        
        //Returns the completed users array containing all of the user associative arrays
        return $jobs;
    }
    
    //Takes in a userID and returns an associative array containing that user's infromation from the database
    public function findByID(int $id){
        Log::info("Entering JobDAO.findByID()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM JOBS WHERE IDJOBS = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting JobDAO.findByID()");
        //Returns whether or not the query found anything and the user in the event that it did
        return ['result' => $statement->rowCount(), 'job' => $statement->fetch(PDO::FETCH_ASSOC)];
    }
    
    /*Takes a Login model as an argument and checks the database for an entry with both the appropriate username and password
    this method is to be used for the purpose of authenticating a user during login or for any other security check*/
    public function findByLogin(JobModel $job){
        Log::info("Entering UserDAO.authenticate()");
        
        try{
            //Gets username and password from the login model
            $username = $user->getUsername();
            $password = $user->getPassword();
            
            $statement = $this->conn->prepare("SELECT * FROM USERS WHERE USERNAME = :username AND PASSWORD = :password");
            //Binds the username and password to the respective query tokens
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $password);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exit UserDAO.authenticate()");
        //Returns the result of the query and an associative array representing the user
        return ['result' => $statement->rowCount(), 'user' => $statement->fetch(PDO::FETCH_ASSOC)];
    }
    
    //Takes in a usermodel and uses it to create a new user in the database
    public function create(JobModel $job){
        Log::info("Entering JobDAO.newJob()");
        
        try{
            //Gets all of the information from the usermodel passed as an argument
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
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exit JobDAO.newJob()");
        //Returns the result of the database query as well as the ID of the created user
        return ['result' => $statement->rowCount(), 'insertID' => $this->conn->lastInsertID()];
    }
    
    //Takes a usermodel as an argument and updates the user's database entry with the information passed
    public function update(JobModel $job){
        Log::info("Entering JobDAO.update()");
        
        try{
            //Gets all of the information from the usermodel
            $id = $job->getId();
            $title = $job->getTitle();
            $company = $job->getCompany();
            $state = $job->getState();
            $city = $job->getCity();
            $description = $job->getDescription();
           
            
            $statement = $this->conn->prepare("UPDATE `JOBS` SET `TITLE` = :title, `COMPANY` = :company, `STATE` = :state, `CITY` = :city, `DESCRIPTION` = :description WHERE `IDJOBS` = :id");
            //Binds all of the information from the usermodel to their respective query tokens
            $statement->bindParam(':title', $title);
            $statement->bindParam(':company', $company);
            $statement->bindParam(':state', $state);
            $statement->bindParam(':city', $city);
            $statement->bindParam(':description', $description);
            
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exit JobDAO.update()");
        //Returns the result of the query
        return $statement->rowCount();
    }
    
    //Takes in an ID as an argument and attempts to delete the user
    public function remove($id){
        Log::info("Entering JobDAO.remove()");
        
        try{            
            $statement = $this->conn->prepare("DELETE FROM `JOBS` WHERE `IDJOBS` = :id");
            //Binds the ID passed as an argument to the query
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exit JobDAO.remove()");
        //Returns the result of the query
        return $statement->rowCount();
    }
}