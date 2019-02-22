<?php

namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use PDO;
use App\Services\Utility\DatabaseException;
use App\Models\ExperienceModel;

class ExperienceDAO{
    
    private $conn;
    
    public function __construct($connection){
        $this->conn = $connection;
    }
    
    public function getByID(int $id){
        Log::info("Entering ExperienceDAO.getByID()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM EXPERIENCE WHERE USERS_IDUSERS = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $results = [];
        
        while($result = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($results, $result);
        }
        
        Log::info("Exit ExperienceDAO.getByID()");
        
        return ['result' => $statement->rowCount(), 'experience' => $results];
    }
    
    public function getAll(){
        Log::info("Entering ExperienceDAO.getAll()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM EXPERIENCE");
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $results = [];
        
        while($result = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($results, $result);
        }
        
        Log::info("Exit ExperienceDAO.getAll()");

        return $results;
    }
    
    public function create(ExperienceModel $experience){
        
        Log::info("Entering ExperienceDAO.create()");
        
        $title = $experience->getTitle();
        $company = $experience->getCompany();
        $current = $experience->getCurrent();
        $startyear = $experience->getStartyear();
        $endyear = $experience->getEndyear();
        $description = $experience->getDescription();
        $userID = $experience->getUserID();
        
        try{
            $statement = $this->conn->prepare("INSERT INTO EXPERIENCE (IDEXPERIENCE, TITLE, COMPANY, CURRENT, STARTYEAR, ENDYEAR, DESCRIPTION, USERS_IDUSERS) VALUES (NULL, :title, :company, :current, :startyear, :endyear, :description, :userID)");
            $statement->bindParam(':title', $title);
            $statement->bindParam(':company', $company);
            $statement->bindParam(':current', $current);
            $statement->bindParam(':startyear', $startyear);
            $statement->bindParam(':endyear', $endyear);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':userID', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message', $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting ExperienceDAO.create()");
        return $statement->rowCount();
    }
    
    public function update(ExperienceModel $experience){
        
        Log::info("Entering ExperienceDAO.update()");
        
        $id = $experience->getId();
        $title = $experience->getTitle();
        $company = $experience->getCompany();
        $current = $experience->getCurrent();
        $startyear = $experience->getStartyear();
        $endyear = $experience->getEndyear();
        $description = $experience->getDescription();
        
        try{
            $statement = $this->conn->prepare("UPDATE EXPERIENCE SET TITLE = :title, COMPANY = :company, CURRENT = :current, STARTYEAR = :startyear, ENDYEAR = :endyear, DESCRIPTION = :description WHERE IDEXPERIENCE = :id");
            $statement->bindParam(':id', $id);
            $statement->bindParam(':title', $title);
            $statement->bindParam(':company', $company);
            $statement->bindParam(':current', $current);
            $statement->bindParam(':startyear', $startyear);
            $statement->bindParam(':endyear', $endyear);
            $statement->bindParam(':description', $description);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message', $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting ExperienceDAO.update()");
        return $statement->rowCount();
    }
    
    public function remove(int $id){
        
        Log::info("Entering ExperienceDAO.remove()");
        
        try{
            $statement = $this->conn->prepare("DELETE FROM EXPERIENCE WHERE IDEXPERIENCE = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message', $e->getMessage()]);
            throw new DatabaseException("Database Exception: ".$e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting ExperienceDAO.remove()");
        return $statement->rowCount();
    }
}