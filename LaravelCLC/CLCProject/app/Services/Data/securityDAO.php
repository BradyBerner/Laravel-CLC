<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 1-20-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Data;

use App\Models\UserModel;
use Illuminate\Support\Facades\DB;

class securityDAO{
    
    //Returns a boolean denoting whether or not the passed username and password passed as arguments
    //are valid entries in the database
    public function authenticate($username, $password){
        return DB::select('SELECT * FROM Users WHERE Username = ? AND Password = ?', [$username, $password]);
    }
    
    //Commits the usermodel object's information as a new entry in the users table and then returns
    //a boolean denoting whether or not the query succeded
    public function register(UserModel $user){
        return DB::insert('INSERT INTO Users (idUsers, Username, Password, Email, FirstName, LastName) VALUES (NULL, ?, ?, ?, ?, ?)', [$user->getUsername(), $user->getPassword(), $user->getEmail(), $user->getFirstName(), $user->getLastName()]);
    }
}