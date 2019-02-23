<?php

namespace App\Services\Data;

use App\Models\SkillModel;
use Illuminate\Support\Facades\Log;
use PDO;
use App\Services\Utility\DatabaseException;

class SkillDAO{
    
    private $connection;
    
    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }
    
    public function findByID(int $id){
        
        Log::info("Entering SkillDAO.findByID()");
        
        try{
            
            $statement = $this->connection->prepare("SELECT * FROM SKILLS WHERE USERS_IDUSERS = :userID");
            $statement->bindParam('userID', $id);
            $statement->execute();
            
            $results = [];
            
            while($result = $statement->fetch(PDO::FETCH_ASSOC)){
                array_push($results, $result);
            }
            
        } catch(\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting SkillDAO.findByID()");
        
        return ['result' => $statement->rowCount(), 'skills' => $results];
    }
    
    public function create(SkillModel $skill){
        
        Log::info("Entering SkillDAO.create()");
        
        try{
            $skillName = $skill->getSkill();
            $description = $skill->getDescription();
            $userID = $skill->getUserID();
            
            $statement = $this->connection->prepare("INSERT INTO SKILLS (IDSKILLS, SKILL, DESCRIPTION, USERS_IDUSERS) VALUES (NULL, :skill, :description, :userID)");
            $statement->bindParam(':skill', $skillName);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':userID', $userID);
            $statement->execute();
        } catch(\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting SkillDAO.create()");
        
        return $statement->rowCount();
    }
    
    public function remove($id){
        
        Log::info("Entering SkillDAO.remove()");
        
        try{
            
            $statement = $this->connection->prepare("DELETE FROM SKILLS WHERE IDSKILLS = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting SkillDAO.remove()");
        
        return $statement->rowCount();
    }
}