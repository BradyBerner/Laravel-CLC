<?php

namespace App\Models;

class AddressModel{
    
    private $id;
    private $street;
    private $city;
    private $state;
    private $zip;
    private $userID;
    
    public function __construct(int $id, string $street, string $city, string $state, string $zip, int $userID){
        $this->id = $id;
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->userID = $userID;
    }
    
    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @return int
     */
    public function getUserID()
    {
        return $this->userID;
    }

}