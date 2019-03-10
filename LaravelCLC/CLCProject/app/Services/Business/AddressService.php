<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-3-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use App\Services\Utility\Connection;
use App\Services\Utility\MyLogger;
use App\Services\Data\AddressDAO;
use App\Models\AddressModel;

class AddressService{
    
    //Takes in a user's ID and returns the address associated with that ID
    public function findByUserID(int $userID){
        
        MyLogger::getLogger()->info("Entering AddressService.findByUserID()");
        
        $connection = new Connection();
        
        $DAO = new AddressDAO($connection);
        
        $result = $DAO->findByUserID($userID);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting AddressService.findByUserID()");
        
        return $result;
    }
    
    //Takes in an address model and updates the corresponding database entries information
    public function editAddress(AddressModel $address){
        
        MyLogger::getLogger()->info("Entering AddressService.editAddress()");
        
        $connection = new Connection();
        
        $DAO = new AddressDAO($connection);
        
        $result = $DAO->editAddress($address);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting AddressService.editAddress()");
        
        return $result;
    }
    
    //Takes in a user's ID and creates a new address in the database using that ID as the foreign key
    public function createAddress(int $userID, $connection){
        
        MyLogger::getLogger()->info("Entering AddressService.createAddress()");
        
        $DAO = new AddressDAO($connection);
        
        $result = $DAO->createAddress($userID);
        
        $connection = null;
        
        MyLogger::getLogger()->info("Exiting AddressService.createAddress() with a result of " . $result);
        
        return $result;
    }
}