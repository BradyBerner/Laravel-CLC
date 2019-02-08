<?php

namespace App\Models;

class LoginModel{
    
    private $username;
    private $password;
    
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