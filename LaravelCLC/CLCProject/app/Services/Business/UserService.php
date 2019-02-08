<?php

namespace App\Services\Business;

use Illuminate\Support\Facades\Log;
use App\Services\Utility\Connection;
use App\Services\Data\UserDAO;
use App\Models\UserModel;

class UserService{
    
    public function findByID(int $id){
        
        Log::info("Entering UserService.getAllUsers()");
        
        $connection = new Connection();
        
        $DAO = new UserDAO($connection);
        
        $results = $DAO->findByID($id);
        
        Log::info("Exiting UserService.findByID()");
        
        return $results;
    }
    
    public function getAllUsers(){
        
        Log::info("Entering UserService.getAllUsers()");
        
        $connection = new Connection();
        
        $DAO = new UserDAO($connection);
        
        $results = $DAO->getAll();
        
        Log::info("Exiting UserService.getAllUsers()");
        
        return $results;
    }
    
    public function editUser(UserModel $user){
        
        Log::info("Entering UserService.editUser");
        
        $connection = new Connection();
        
        $DAO = new UserDAO($connection);
        
        $results = $DAO->update($user);
        
        Log::info("Exiting UserService.editUser()");
        
        return $results;
    }
    
    public function removeUser($id){
        
        Log::info("Entering UserService.removeUser()");
        
        $connection = new Connection();
        
        $DAO = new UserDAO($connection);
        
        $results = $DAO->remove($id);
        
        Log::info("Exiting UserService.removeUser()");
        
        return $results;
    }
}