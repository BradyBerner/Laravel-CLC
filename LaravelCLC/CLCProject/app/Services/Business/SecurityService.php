<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Utility\Connection;
use App\Services\Utility\MyLogger;
use PDO;
use App\Services\Data\UserDAO;
use App\Services\Utility\DatabaseException;

class SecurityService
{

    // Function takes user as an argument and calls the database registration service with that user then returns
    // the result it gets
    public function register(UserModel $user)
    {
        MyLogger::getLogger()->info("Entering SecurityService.register()");

        try{
        $connection = new Connection();
        $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
        $connection->beginTransaction();

        $DAO = new UserDAO($connection);

        $result = $DAO->create($user);

        if ($result['result']) {
            
            $userID = $result['insertID'];

            // Creates instances of the business services having to do with user information
            $infoService = new UserInfoService();
            $addressService = new AddressService();

            // Creates new entries in information tables corresponding to the user with the new user's ID
            $infoResult = $infoService->createUserInfo($userID, $connection);
            $addressResult = $addressService->createAddress($userID, $connection);
            
            if($infoResult && $addressResult){
                $connection->commit();
            } else {
                $connection->rollBack();
            }
        }

        $connection = null;
        
        } catch (\Exception $e){
            MyLogger::getLogger()->error("Database exception: ", $e->getMessage());
            $connection->rollBack();
            throw new DatabaseException("Exception: " . $e->getMessage(), $e, 0);
        }

        MyLogger::getLogger()->info("Exiting SecurityService.register() with result: " . $result['result']);

        return $result;
    }

    // Function takes user as an argument and calls the database login service and returns the result
    public function login(UserModel $user)
    {
        MyLogger::getLogger()->info("Entering SecurityService.login()");

        $connection = new Connection();

        $DAO = new UserDAO($connection);

        $connection = null;

        $result = $DAO->findByLogin($user);

        MyLogger::getLogger()->info("Exiting SecurityService.login() with result: " . $result['result']);
        
        return $result;
    }
}