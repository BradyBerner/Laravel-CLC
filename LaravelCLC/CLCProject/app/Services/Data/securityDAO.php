<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 1-20-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Data;

use App\Models\UserModel;
use App\Models\LoginModel;
use Illuminate\Support\Facades\DB;
use Exception;

class securityDAO{
    
    //Returns a boolean denoting whether or not the passed username and password passed as arguments
    //are valid entries in the database
    public function authenticate(LoginModel $user){
        try{
            return DB::select('SELECT * FROM Users WHERE Username = ? AND Password = ?', [$user->getUsername(), $user->getPassword()]);
        } catch (Exception $e){
            
        }
    }
    
    //Commits the usermodel object's information as a new entry in the users table and then returns
    //a boolean denoting whether or not the query succeded
    public function register(UserModel $user){
        try{
            return DB::insert('INSERT INTO Users (idUsers, Username, Password, Email, FirstName, LastName, Role) VALUES (NULL, ?, ?, ?, ?, ?, NULL)', [$user->getUsername(), $user->getPassword(), $user->getEmail(), $user->getFirstName(), $user->getLastName()]);
        } catch (Exception $e){
            
        }
    }
}