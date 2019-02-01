<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 1-20-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use App\Models\UserModel;
use App\Models\LoginModel;
use App\Services\Data\securityDAO;
use App\Services\Utility\Connection;
use Illuminate\Support\Facades\Log;

class SecurityService{
    
    //Function takes user as an argument and calls the database registration service with that user then returns
    //the result it gets
    public function register(UserModel $user){
        
        Log::info("Entering SecurityService.register()");
        
        $connection = new Connection();
        
        $DAO = new securityDAO($connection);
        
        $result = $DAO->register($user);
        
        Log::info("Exiting SecurityService.register() with result: " . $result);
        
        if($result){
            return true;
        } else {
            return false;
        }
    }
    
    //Function takes user as an argument and calls the database login service and returns the result
    public function login(LoginModel $user){
        
        Log::info("Entering SecurityService.login()");
        
        $connection = new Connection();
        
        $DAO = new securityDAO($connection);
        
        $result = $DAO->authenticate($user);
        
        Log::info("Exiting SecurityService.login() with result: " . $result);
        
        if($result){
            return true;
        } else {
            return false;
        }
    }
}