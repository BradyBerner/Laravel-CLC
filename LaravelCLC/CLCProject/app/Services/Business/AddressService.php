<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 2-10-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\Connection;
use App\Services\Data\AddressDAO;
use App\Models\AddressModel;

class AddressService{
    
    public function findByUserID(int $userID){
        
        Log::info("Entering AddressService.findByUserID()");
        
        $connection = new Connection();
        
        $DAO = new AddressDAO($connection);
        
        $result = $DAO->findByUserID($userID);
        
        $connection = null;
        
        Log::info("Exiting AddressService.findByUserID()");
        
        return $result;
    }
    
    public function editAddress(AddressModel $address){
        
        Log::info("Entering AddressService.editAddress()");
        
        $connection = new Connection();
        
        $DAO = new AddressDAO($connection);
        
        $result = $DAO->editAddress($address);
        
        $connection = null;
        
        Log::info("Exiting AddressService.editAddress()");
        
        return $result;
    }
    
    public function createAddress(int $userID){
        
        Log::info("Entering AddressService.createAddress()");
        
        $connection = new Connection();
        
        $DAO = new AddressDAO($connection);
        
        $result = $DAO->createAddress($userID);
        
        $connection = null;
        
        Log:info("Exiting AddressService.createAddress() with a result of " . $result);
        
        return $result;
    }
}