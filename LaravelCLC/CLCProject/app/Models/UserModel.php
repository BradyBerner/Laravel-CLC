<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 1-20-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Models;

class UserModel {
    
    private $id;
    private $Username;
    private $Password;
    private $Email;
    private $FirstName;
    private $LastName;
    private $Status;
    private $Role;
    
    function __construct($id, $Username, $Password, $Email, $FirstName, $LastName, $Status, $Role){
        $this->id = $id;
        $this->Username = $Username;
        $this->Password = $Password;
        $this->Email = $Email;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Status = $Status;
        $this->Role = $Role;
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
    public function getUsername()
    {
        return $this->Username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->LastName;
    }
    
    /**
     *  @return int
     */
    public function getStatus(){
        return $this->Status;
    }

    /**
     * @return int
     */
    public function getRole(){
        return $this->Role;
    }
}