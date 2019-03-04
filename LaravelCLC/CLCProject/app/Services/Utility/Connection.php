<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-3-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Utility;

use Illuminate\Support\Facades\Log;
use PDO;
use Exception;

class Connection extends \PDO{
    
    //Calls super constructor with database information stored within the configuration file
    function __construct(){
        try{
            //Gets all the necessary connection information from the configuration file
            $servername = config("database.connections.mysql.host");
            $username = config("database.connections.mysql.username");
            $password = config("database.connections.mysql.password");
            $dbname = config("database.connections.mysql.database");
            
            //Calls PDO constructor with the config file information
            parent::__construct("mysql:host=$servername;dbname=$dbname", $username, $password);
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
        }
    }
}