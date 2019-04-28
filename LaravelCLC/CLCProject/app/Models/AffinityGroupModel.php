<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Models;

/**
 * Class AffinityGroupModel
 * @package App\Models
 */
class AffinityGroupModel{

    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $description;
    /**
     * @var
     */
    private $focus;
    /**
     * @var
     */
    private $userID;

    /**
     * AffinityGroupModel constructor.
     * @param $id
     * @param $name
     * @param $description
     * @param $focus
     * @param $userID
     */
    public function __construct($id, $name, $description, $focus, $userID){
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->focus = $focus;
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
    public function getName()
    {
        return $this->name;
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
    public function getFocus()
    {
        return $this->focus;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userID;
    }
}