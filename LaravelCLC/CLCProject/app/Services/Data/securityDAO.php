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
use Exception;

class securityDAO{
    
    private $conn;
    
    public function __construct($conn){
        $this->conn = $conn;
    }
    
    //Returns a boolean denoting whether or not the passed username and password passed as arguments
    //are valid entries in the database
//     public function authenticate(LoginModel $user){
//         try{
//             return DB::select('SELECT * FROM Users WHERE Username = ? AND Password = ?', [$user->getUsername(), $user->getPassword()]);
//         } catch (Exception $e){
            
//         }
//     }
    
    public function authenticate(LoginModel $user){
        Log::info("Entering SecurityDAO.authenticate()");
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM Users WHERE Username = :username AND Password = :password");
            $statement->bindParam(':username', $user->getUsername());
            $statement->bindParam(':password', $user->getPassword());
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exit SecurityDAO.authenticate()");
        return $statement->rowCount();
    }
    
    public function register(UserModel $user){
        Log::info("Entering SecurityDAO.register()");
        
        try{
            $statement = $this->conn->prepare("INSERT INTO Users (idUsers, Username, Password, Email, FirstName, LastName, Role) VALUES (NULL, :username, :password, :email, :firstname, :lastname, 0");
            $statement->bindParam(':username', $user->getUsername());
            $statement->bindParam(':password', $user->getPassword());
            $statement->bindParam(':email', $user->getEmail());
            $statement->bindParam();
        } catch (\PDOException $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
    }
    
    //Commits the usermodel object's information as a new entry in the users table and then returns
    //a boolean denoting whether or not the query succeded
//     public function register(UserModel $user){
//         try{
//             return DB::insert('INSERT INTO Users (idUsers, Username, Password, Email, FirstName, LastName, Role) VALUES (NULL, ?, ?, ?, ?, ?, NULL)', [$user->getUsername(), $user->getPassword(), $user->getEmail(), $user->getFirstName(), $user->getLastName()]);
//         } catch (Exception $e){
            
//         }
//     }
}