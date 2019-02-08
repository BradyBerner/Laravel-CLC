<?php

namespace App\Services\Data;

use App\Models\AddressModel;
use App\Services\Utility\Connection;
use Illuminate\Support\Facades\Log;
use PDO;
use App\Services\Utility\DatabaseException;

class AddressDAO{
    
    private $connection;
    
    public function __construct(Connection $conn){
        $this->connection = $conn;
    }
    
    public function findByUserID(int $userID){
        
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
    
    public function editAddress(AddressModel $address){
        
        Log::info("Entering AddressDAO.editAddress()");
        
        try{
            $street = $address->getStreet();
            $city = $address->getCity();
            $state = $address->getState();
            $zip = $address->getZip();
            $userID = $address->getUserID();
            
            $statement = $this->connection->prepare("UPDATE ADDRESS SET STREET = :street, CITY = :city, STATE = :state, ZIP = :zip WHERE USERS_IDUSERS = :userid");
            $statement->bindParam(':street', $street);
            $statement->bindParam(':city', $city);
            $statement->bindParam(':state', $state);
            $statement->bindParam(':zip', $zip);
            $statement->bindParam(':userid', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting AddressDAO.editAddress()");
        return $statement->rowCount();
    }
    
    public function createAddress(int $userID){
        
        Log::info("Entering AddressDAO.createAddress()");
        
        try{
            $statement = $this->connection->prepare("INSERT INTO ADDRESS (IDADDRESS, STREET, CITY, STATE, ZIP, USERS_IDUSERS) VALUES (NULL, NULL, NULL, NULL, NULL, :userid)");
            $statement->bindParam(':userid', $userID);
            $statement->execute();
        } catch (\PDOException $e){
            Log::error("Exception: ", ['message' => $e->getMessage()]);
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        Log::info("Exiting AddressDAO.createAddress()");
        return $statement->rowCount();
    }
}