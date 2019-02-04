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
    
    public function findByLogin(LoginModel $user){
        Log::info("Entering SecurityDAO.authenticate()");
        
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
        
        Log::info("Exit SecurityDAO.authenticate()");
        return ['result' => $statement->rowCount(), 'user' => $statement->fetch(PDO::FETCH_ASSOC)];
    }
    
    public function create(UserModel $user){
        Log::info("Entering SecurityDAO.register()");
        
        try{
            $username = $user->getUsername();
            $password = $user->getPassword();
            $email = $user->getEmail();
            $firstname = $user->getFirstName();
            $lastname = $user->getLastName();
            
            $statement = $this->conn->prepare("INSERT INTO `USERS` (`IDUSERS`, `USERNAME`, `PASSWORD`, `EMAIL`, `FIRSTNAME`, `LASTNAME`, `ROLE`) VALUES (NULL, :username, :password, :email, :firstname, :lastname, '0')");
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
        
        Log::info("Exit SecurityDAO.register()");
        return $statement->rowCount();
    }
}