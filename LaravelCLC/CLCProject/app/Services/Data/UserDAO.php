<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 1-20-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Data;

use App\Models\UserModel;
use App\Models\LoginModel;
use App\Services\Utility\DatabaseException;
use Illuminate\Support\Facades\Log;
use PDO;

class UserDAO{
    
    private $conn;
    
    public function __construct($conn){
        $this->conn = $conn;
    }
    
    public function getAll(){
        Log::info("Entering UserDAO.getAll()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM USERS");
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $users = [];
        
        while($user = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($users, $user);
        }
        
        Log::info("Exit UserDAO.getAll()");
        
        return $users;
    }
    
    public function findByLogin(LoginModel $user){
        Log::info("Entering UserDAO.authenticate()");
        
        try{
            $username = $user->getUsername();
            $password = $user->getPassword();
            
            $statement = $this->conn->prepare("SELECT * FROM USERS WHERE USERNAME = :username AND PASSWORD = :password");
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $password);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exit UserDAO.authenticate()");
        return ['result' => $statement->rowCount(), 'user' => $statement->fetch(PDO::FETCH_ASSOC)];
    }
    
    public function create(UserModel $user){
        Log::info("Entering UserDAO.register()");
        
        try{
            $username = $user->getUsername();
            $password = $user->getPassword();
            $email = $user->getEmail();
            $firstname = $user->getFirstName();
            $lastname = $user->getLastName();
            
            $statement = $this->conn->prepare("INSERT INTO `USERS` (`IDUSERS`, `USERNAME`, `PASSWORD`, `EMAIL`, `FIRSTNAME`, `LASTNAME`, `STATUS`, `ROLE`) VALUES (NULL, :username, :password, :email, :firstname, :lastname, '1', '0')");
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':firstname', $firstname);
            $statement->bindParam(':lastname', $lastname);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exit UserDAO.register()");
        return ['result' => $statement->rowCount(), 'insertID' => $this->conn->lastInsertID()];
    }
    
    public function update(UserModel $user){
        Log::info("Entering UserDAO.update()");
        
        try{
            $id = $user->getId();
            $username = $user->getUsername();
            $password = $user->getPassword();
            $email = $user->getEmail();
            $firstname = $user->getFirstName();
            $lastname = $user->getLastName();
            $status = $user->getStatus();
            $role = $user->getRole();
            
            $statement = $this->conn->prepare("UPDATE `USERS` SET `USERNAME` = :username, `PASSWORD` = :password, `EMAIL` = :email, `FIRSTNAME` = :firstname, `LASTNAME` = :lastname, `STATUS` = :status, `ROLE` = :role WHERE `IDUSERS` = :id");
            $statement->bindParam(':username', $username);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':firstname', $firstname);
            $statement->bindParam(':lastname', $lastname);
            $statement->bindParam(':status', $status);
            $statement->bindParam(':role', $role);
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exit UserDAO.update()");
        return $statement->rowCount();
    }
    
    public function remove($id){
        Log::info("Entering UserDAO.remove()");
        
        try{            
            $statement = $this->conn->prepare("DELETE FROM `USERS` WHERE `IDUSERS` = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ["message" => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exit UserDAO.remove()");
        return $statement->rowCount();
    }
}