<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Models;

/**
 * Class ExperienceModel
 * @package App\Models
 */
class ExperienceModel{

    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $title;
    /**
     * @var
     */
    private $company;
    /**
     * @var
     */
    private $current;
    /**
     * @var
     */
    private $startyear;
    /**
     * @var
     */
    private $endyear;
    /**
     * @var
     */
    private $description;
    /**
     * @var
     */
    private $userID;

    /**
     * ExperienceModel constructor.
     * @param $id
     * @param $title
     * @param $company
     * @param $current
     * @param $startyear
     * @param $endyear
     * @param $description
     * @param $userID
     */
    public function __construct($id, $title, $company, $current, $startyear, $endyear, $description, $userID){
        $this->id = $id;
        $this->title = $title;
        $this->company = $company;
        $this->current = $current;
        $this->startyear = $startyear;
        $this->endyear = $endyear;
        $this->description = $description;
        $this->userID = $userID;
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
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @return mixed
     */
    public function getStartyear()
    {
        return $this->startyear;
    }

    /**
     * @return mixed
     */
    public function getEndyear()
    {
        return $this->endyear;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }

}