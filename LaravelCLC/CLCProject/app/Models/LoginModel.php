<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 2-10-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Models;

class LoginModel{
    
    //Attrubutes necessary for a user to log in
    private $username;
    private $password;
    
    //Sets the attributes equal to the corresponding argument passed
    public function __construct(string $username, string $password){
        $this->username = $username;
        $this->password = $password;
    }
    
    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

}