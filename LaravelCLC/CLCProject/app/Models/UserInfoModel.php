<?php

namespace App\Models;

class UserInfoModel {
    
    private $id;
    private $description;
    private $phone;
    private $age;
    private $gender;
    private $userID;
    
    public function __construct($id, $description, $phone, $age, $gender, $userID){
        $this->id = $id;
        $this->description = $description;
        $this->phone = $phone;
        $this->age = $age;
        $this->gender = $gender;
        $this->userID = $userID;
    }
    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @return int
     */
    public function getUserID()
    {
        return $this->userID;
    }
}