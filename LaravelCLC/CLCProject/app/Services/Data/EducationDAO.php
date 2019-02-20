<?php

namespace App\Services\Data;

use Illuminate\Support\Facades\Log;
use PDO;
use App\Services\Utility\DatabaseException;
use App\Models\EducationModel;

class EducationDAO{
    
    private $conn;
    
    public function __construct($connection){
        $this->conn = $connection;
    }
    
    public function getByID(int $id){
        Log::info("Entering EducationDAO.getByID()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM EDUCATION WHERE IDEDUCATION = :id");
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
        
        Log::info("Exit EducationDAO.getByID()");
        
        return ['result' => $statement->rowCount(), 'education' => $statement->fetch(PDO::FETCH_ASSOC)];
    }
    
    public function getAll(){
        Log::info("Entering EducationDAO.getAll()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM EDUCATION");
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $results = [];
        
        while($result = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($results, $result);
        }
        
        Log::info("Exit EducationDAO.getAll()");
        
        return $results;
    }
    
    public function create(EducationModel $education){
        
        Log::info("Entering EducationDAO.create()");
        
        $degree = $education->getDegree();
        $field = $education->getField();
        $gpa = $education->getGpa();
        $startyear = $education->getStartyear();
        $endyear = $education->getEndyear();
        $userID = $education->getUserID();
        
        try{
            $statement = $this->conn->prepare("INSERT INTO EDUCATION (IDEDUCATION, DEGREE, FIELD, GPA, STARTYEAR, ENDYEAR, USERS_IDUSERS) VALUE (NULL, :degree, :field, :gpa, :startyear, :endyear, :userID)");
            $statement->bindParam(':degree', $degree);
            $statement->bindParam(':field', $field);
            $statement->bindParam(':gpa', $gpa);
            $statement->bindParam(':startyear', $startyear);
            $statement->bindParam(':endyear', $endyear);
            $statement->bindParam(':userID', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message', $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting EducationDAO.create()");
        return $statement->rowCount();
    }
    
    public function update(EducationModel $education){
        
        Log::info("Entering EducationDAO.update()");
        
        $id = $education->getId();
        $degree = $education->getDegree();
        $field = $education->getField();
        $gpa = $education->getGpa();
        $startyear = $education->getStartyear();
        $endyear = $education->getEndyear();
        $userID = $education->getUserID();
        
        try{
            $statement = $this->conn->prepare("UPDATE EDUCATION SET DEGREE = :degree, FIELD = :field, GPA = :gpa, STARTYEAR = :startyear, ENDYEAR = :endyear WHERE IDEDUCATION = :id");
            $statement->bindParam(':id', $id);
            $statement->bindParam(':degree', $degree);
            $statement->bindParam(':field', $field);
            $statement->bindParam(':gpa', $gpa);
            $statement->bindParam(':startyear', $startyear);
            $statement->bindParam(':endyear', $endyear);
            $statement->bindParam(':userID', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message', $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting EducationDAO.update()");
        return $statement->rowCount();
    }
    
    public function remove(int $id){
        
        Log::info("Entering EducationDAO.remove()");
        
        try{
            $statement = $this->conn->prepare("DELETE FROM EDUCATION WHERE IDEDUCATION = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message', $e->getMessage()]);
            throw new DatabaseException("Database Exception: ".$e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting EducationDAO.remove()");
        return $statement->rowCount();
    }
}