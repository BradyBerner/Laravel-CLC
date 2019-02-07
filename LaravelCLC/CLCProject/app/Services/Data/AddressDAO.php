<?php

namespace App\Models;

use App\Services\Utility\Connection;
use Illuminate\Support\Facades\Log;
use PDO;
use App\Services\Utility\DatabaseException;

class AddressDAO{
    
    private $connection;
    
    public function __construct(Connection $conn){
        $this->connection = $conn;
    }
    
    public function findByUserID($userID){
        
        Log::info("Entering AddressDAO.findByUserID()");
        
        try{
            $statement = $this->connection->prepare("SELECT * FROM ADDRESS WHERE USERS_IDUSERS = :id");
            $statement->bindParam(':id', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting AddressDAO.findByUserID()");
        return ['result' => $statement->rowCount(), 'address' => $statement->fetch(PDO::FETCH_ASSOC)];
    }
}