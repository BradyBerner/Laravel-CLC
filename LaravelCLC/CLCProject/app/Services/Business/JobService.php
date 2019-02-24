<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 2-10-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Services\Business;

use App\Models\JobModel;
use App\Services\Utility\Connection;
use Illuminate\Support\Facades\Log;
use App\Services\Data\JobDAO;

class JobService
{

    // Function takes user as an argument and calls the database registration service with that user then returns
    // the result it gets
    public function newJob(JobModel $job)
    {
        Log::info("Entering JobService.newJob()");

        $connection = new Connection();

        $DAO = new JobDAO($connection);

        $result = $DAO->create($job);

        $connection = null;

        Log::info("Exiting JobService.newJob() with result: " . $result['result']);

        return $result;
    }
    
    public function getAllJobs(){
        
        Log::info("Entering JobService.getAllUsers()");
        
        //Creates connection with the database
        $connection = new Connection();
        
        //Creates data access object instance
        $DAO = new JobDAO($connection);
        
        //Stores the results of the data access object's get all method.
        $results = $DAO->getAll();
        
        //Closes the connection to the databse
        $connection = null;
        
        Log::info("Exiting JobService.getAllUsers()");
        
        //Returns the results obtained from the data access object
        return $results;
    }
    
    public function editJob(JobModel $job){
        
        Log::info("Entering JobService.editJob");
        
        //Creates connection with the database
        $connection = new Connection();
        
        //Creates data access object instance
        $DAO = new JobDAO($connection);
        
        //Stores the results of the data access object's function call
        $results = $DAO->update($job);
        
        //Closes the connection to the database
        $connection = null;
        
        Log::info("Exiting JobService.editJob()");
        
        //Returns the results obtained from the data access object
        return $results;
    }
    
    public function removeJob($id){
        
        Log::info("Entering JobService.removeJob()");
        
        //Creates connection with the database
        $connection = new Connection();
        
        //Creates data access object instance
        $DAO = new JobDAO($connection);
        
        //Stores the results of the data access object's function call
        $results = $DAO->remove($id);
        
        //Closes the connection to the database
        $connection = null;
        
        Log::info("Exiting UserService.removeUser()");
        
        //Returns the results obtained from the data access object
        return $results;
    }

  }