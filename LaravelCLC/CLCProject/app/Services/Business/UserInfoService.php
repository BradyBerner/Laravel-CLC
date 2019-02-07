<?php

namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\Connection;
use App\Models\UserInfoDAO;
use App\Models\UserInfoModel;

class UserInfoService{
    
    public function findByUserID(int $userID){
        
        Log::info("Entering UserInfoService.findByUserID()");
        
        $connection = new Connection();
        
        $DAO = new UserInfoDAO($connection);
        
        $result = $DAO->findByUserID($userID);
        
        Log::info("Exiting UserInfoService.findByUserID()");
        
        return $result;
    }
    
    public function editUserID(UserInfoModel $userInfo){
        
        Log::info("Entering UserInfoService.editUserID()");
        
        $connection = new Connection();
        
        $DAO = new UserInfoDAO($connection);
        
        $result;
    }
}