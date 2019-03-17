<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Data;

use App\Models\SkillModel;
use PDO;
use App\Services\Utility\DatabaseException;
use App\Services\Utility\MyLogger;

class SkillDAO{
    
    //Field to store the PDO connection to the database
    private $connection;
    
    //Sets the connection field
    public function __construct(\PDO $connection){
        $this->connection = $connection;
    }
    
    //Gets all of the skills connected to a certain user
    public function findByID(int $id){
        
        MyLogger::getLogger()->info("Entering SkillDAO.findByID()");
        
        try{
            $statement = $this->connection->prepare("SELECT * FROM SKILLS WHERE USERS_IDUSERS = :userID");
            $statement->bindParam('userID', $id);
            $statement->execute();
            
            $results = [];
            
            //Adds all of the results from the database query to the results array
            while($result = $statement->fetch(PDO::FETCH_ASSOC)){
                array_push($results, $result);
            }
            
        } catch(\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        MyLogger::getLogger()->info("Exiting SkillDAO.findByID()");
        
        return ['result' => $statement->rowCount(), 'skills' => $results];
    }
    
    //Takes a skill model as an argument and creates a new skill entry in the database
    public function create(SkillModel $skill){
        
        MyLogger::getLogger()->info("Entering SkillDAO.create()");
        
        try{
            //Gets the information needed from the skill object
            $skillName = $skill->getSkill();
            $description = $skill->getDescription();
            $userID = $skill->getUserID();
            
            $statement = $this->connection->prepare("INSERT INTO SKILLS (IDSKILLS, SKILL, DESCRIPTION, USERS_IDUSERS) VALUES (NULL, :skill, :description, :userID)");
            $statement->bindParam(':skill', $skillName);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':userID', $userID);
            $statement->execute();
        } catch(\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        MyLogger::getLogger()->info("Exiting SkillDAO.create()");
        
        return $statement->rowCount();
    }
    
    //Takes in the ID of the skill and then removes the associated skill from the database
    public function remove($id){
        
        MyLogger::getLogger()->info("Entering SkillDAO.remove()");
        
        try{
            
            $statement = $this->connection->prepare("DELETE FROM SKILLS WHERE IDSKILLS = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            MyLogger::getLogger()->error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        MyLogger::getLogger()->info("Exiting SkillDAO.remove()");
        
        return $statement->rowCount();
    }
}