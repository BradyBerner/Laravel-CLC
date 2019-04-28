<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Models;

/**
 * Class EducationModel
 * @package App\Models
 */
class EducationModel{

    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $school;
    /**
     * @var
     */
    private $degree;
    /**
     * @var
     */
    private $field;
    /**
     * @var
     */
    private $gpa;
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
    private $userID;

    /**
     * EducationModel constructor.
     * @param $id
     * @param $school
     * @param $degree
     * @param $field
     * @param $gpa
     * @param $startyear
     * @param $endyear
     * @param $userID
     */
    public function __construct($id, $school, $degree, $field, $gpa, $startyear, $endyear, $userID){
        $this->id = $id;
        $this->school = $school;
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
    public function getSchool(){
        return $this->school;
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