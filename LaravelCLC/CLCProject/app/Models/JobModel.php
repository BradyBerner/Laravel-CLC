<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Models;

class JobModel
{
    //Attributes corresponding to the data stored in the database for all entries of the corresponding table
    private $id;
    private $title;
    private $company;
    private $state;
    private $city;
    private $description;
    
    //Sets all attributes equal to the corresponding value passed to the constructor
    function __construct($id,$title,$company,$state,$city,$description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->company = $company;
        $this->state = $state;
        $this->city = $city;
        $this->description = $description;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

}