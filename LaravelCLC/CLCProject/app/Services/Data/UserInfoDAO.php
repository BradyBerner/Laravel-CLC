<?php

namespace App\Services\Data;

use App\Models\UserInfoModel;
use App\Services\Utility\Connection;
use Illuminate\Support\Facades\Log;
use PDO;
use App\Services\Utility\DatabaseException;

class UserInfoDAO{
    
    private $connection;
    
    public function __construct(Connection $conn){
        $this->connection = $conn;
    }
    
    public function findByUserID(int $id){
        Log::info("Entering UserInfoDAO.findByUserID()");
        
        try{
            $statement = $this->connection->prepare("SELECT * FROM USER_INFO WHERE USERS_IDUSERS = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting UserInfoDAO.findByUserID()");
        return ['result' => $statement->rowCount(), 'userInfo' => $statement->fetch(PDO::FETCH_ASSOC)];
    }
    
    public function createNewUserInfo(int $userID){
        Log::info("Entering UserInfoDAO.createNewUserInfo()");
        
        try{
            $statement = $this->connection->prepare("INSERT INTO USER_INFO (IDUSER_INFO, DESCRIPTION, PHONE, AGE, GENDER, USERS_IDUSERS) VALUES (NULL, NULL, NULL, NULL, NULL, :userid)");
            $statement->bindParam(':userid', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting UserInfoDAO.createNewUserInfo()");
        return $statement->rowCount();
    }
    
    public function editUserInfo(UserInfoModel $userInfo){
        
        Log::info("Entering UserInfoDAO.editUserInfo()");
        
        try{
            $description = $userInfo->getDescription();
            $age = $userInfo->getAge();
            $gender = $userInfo->getGender();
            $phone = $userInfo->getPhone();
            $userID = $userInfo->getUserID();
            
            $statement = $this->connection->prepare("UPDATE USER_INFO SET DESCRIPTION = :description, PHONE = :phone, AGE = :age, GENDER = :gender WHERE USERS_IDUSERS = :userid");
            $statement->bindParam(':description', $description);
            $statement->bindParam(':phone', $phone);
            $statement->bindParam(':age', $age);
            $statement->bindParam(':gender', $gender);
            $statement->bindParam(':userid', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting UserInfoDAO.editUserInfo()");
        return $statement->rowCount();
    }
}