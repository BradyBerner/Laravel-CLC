<?php

namespace App\Models;

class EducationModel{
    
    private $id;
    private $degree;
    private $field;
    private $gpa;
    private $startyear;
    private $endyear;
    private $userID;
    
    public function __construct($id, $degree, $field, $gpa, $startyear, $endyear, $userID){
        $this->id = $id;
        $this->degree = $degree;
        $this->field = $field;
        $this->gpa = $gpa;
        $this->startyear = $startyear;
        $this->endyear = $endyear;
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
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     */
    public function getGpa()
    {
        return $this->gpa;
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
    public function getUserID()
    {
        return $this->userID;
    }

}