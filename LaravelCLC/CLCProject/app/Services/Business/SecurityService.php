<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 1-20-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Data\securityDAO;

class SecurityService{
    
    //Function takes user as an argument and calls the database registration service with that user then returns
    //the result it gets
    public function register(UserModel $user){
        $DAO = new securityDAO();
        return $DAO->register($user);
    }
    
    //Function takes user as an argument and calls the database login service and returns the result
    public function login($username, $password){
        $DAO = new securityDAO();
        return $DAO->authenticate($username, $password);
    }
}