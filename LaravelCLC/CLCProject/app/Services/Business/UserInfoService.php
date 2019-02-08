<?php

namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\Connection;
use App\Services\Data\UserInfoDAO;
use App\Models\UserInfoModel;

class UserInfoService{
    
    public function findByUserID(int $userID){
        
        Log::info("Entering UserInfoService.findByUserID()");
        
        $connection = new Connection();
        
        $DAO = new UserInfoDAO($connection);
        
        $result = $DAO->findByUserID($userID);
        
        $connection = null;
        
        Log::info("Exiting UserInfoService.findByUserID()");
        
        return $result;
    }
    
    public function editUserInfo(UserInfoModel $userInfo){
        
        Log::info("Entering UserInfoService.editUserID()");
        
        $connection = new Connection();
        
        $DAO = new UserInfoDAO($connection);
        
        $result = $DAO->editUserInfo($userInfo);
        
        $connection = null;
        
        Log::info("Exiting UserInfoService.editUserID()");
        
        return $result;
    }
    
    public function createUserInfo(int $userID){
        
        Log::info("Entering UserInfoService.createUserInfo()");
        
        $connection = new Connection();
        
        $DAO = new UserInfoDAO($connection);
        
        $result = $DAO->createNewUserInfo($userID);
        
        $connection = null;
        
        Log::info("Exiting UserInfoService.createUserInfo()");
        
        return $result;
    }
}