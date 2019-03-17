<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Models;

class SkillModel{
    
    private $id;
    private $skill;
    private $description;
    private $userID;
    
    public function __construct($id, $skill, $description, $userID){
        $this->id = $id;
        $this->skill = $skill;
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
    public function getSkill()
    {
        return $this->skill;
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