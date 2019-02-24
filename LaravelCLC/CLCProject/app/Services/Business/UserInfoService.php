<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 2-24-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\Connection;
use App\Services\Data\UserInfoDAO;
use App\Models\UserInfoModel;

class UserInfoService{
    
    //Attempts to find the userInfo associated with the passed user ID
    public function findByUserID(int $userID){
        
        Log::info("Entering UserInfoService.findByUserID()");
        
        //Creates connection to the database
        $connection = new Connection();
        
        //Creates an instance of the data access object
        $DAO = new UserInfoDAO($connection);
        
        //Stores the results of the associated data access object function
        $result = $DAO->findByUserID($userID);
        
        //Closes the connection to the database
        $connection = null;
        
        Log::info("Exiting UserInfoService.findByUserID()");
        
        //Returns the result from the data access object
        return $result;
    }
    
    //Takes a userInfoModel object as an argument and attempts to update the corresponding database entry
    public function editUserInfo(UserInfoModel $userInfo){
        
        Log::info("Entering UserInfoService.editUserID()");
        
        //Creates connection to the database
        $connection = new Connection();
        
        //Creates an instance of the data access object
        $DAO = new UserInfoDAO($connection);
        
        //Stores the results of the associated data access object function
        $result = $DAO->editUserInfo($userInfo);
        
        //Closes the connection to the database
        $connection = null;
        
        Log::info("Exiting UserInfoService.editUserID()");
        
        //Returns the result from the data access object
        return $result;
    }
    
    //Creates a new userInfo entry in the database with a foreign key corresponding to the ID passed as an argumnet
    public function createUserInfo(int $userID, $connection){
        
        Log::info("Entering UserInfoService.createUserInfo()");
        
        //Creates an instance of the data access object
        $DAO = new UserInfoDAO($connection);
        
        //Stores the results of the associated data access object function
        $result = $DAO->createNewUserInfo($userID);
        
        //Closes the connection to the database
        $connection = null;
        
        Log::info("Exiting UserInfoService.createUserInfo()");
        
        //Returns the result from the data access object
        return $result;
    }
}