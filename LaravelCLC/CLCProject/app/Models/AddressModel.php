<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Models;

/**
 * Class AddressModel
 * @package App\Models
 */
class AddressModel{
    
    //Attrubutes corresponding to the database columns for the table representing the same object type
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $street;
    /**
     * @var
     */
    private $city;
    /**
     * @var
     */
    private $state;
    /**
     * @var
     */
    private $zip;
    /**
     * @var
     */
    private $userID;
    
    //Constructor that sets all of the attributes equal to the arguments passed

    /**
     * AddressModel constructor.
     * @param $id
     * @param $street
     * @param $city
     * @param $state
     * @param $zip
     * @param $userID
     */
    public function __construct($id, $street, $city, $state, $zip, $userID){
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