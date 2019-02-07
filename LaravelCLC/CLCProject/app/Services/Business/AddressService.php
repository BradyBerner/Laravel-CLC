<?php

namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\Connection;
use App\Models\AddressDAO;

class AddressService{
    
    public function findByUserID($userID){
        
        Log::info("Entering AddressService.findByUserID()");
        
        $connection = new Connection();
        
        $DAO = new AddressDAO($connection);
        
        $result = $DAO->findByUserID($userID);
        
        Log::info("Exiting AddressService.findByUserID()");
        return $result;
    }
}