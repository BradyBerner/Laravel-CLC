<?php

namespace App\Services\Utility;

use Illuminate\Support\Facades\Log;
use PDO;
use Exception;

class Connection extends \PDO{
    
    function __construct(){
        try{
            $servername = config("database.connections.mysql.host");
            $username = config("database.connections.mysql.username");
            $password = config("database.connections.mysql.password");
            $dbname = config("database.connections.mysql.database");
            
            parent::__construct("mysql:host=$servername;dbname=$dbname", $username, $password);
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
        }
    }
}