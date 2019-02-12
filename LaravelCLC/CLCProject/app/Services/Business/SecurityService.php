<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 2-10-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Services\Business;

use App\Models\UserModel;
use App\Models\LoginModel;
use App\Services\Utility\Connection;
use Illuminate\Support\Facades\Log;
use PDO;
use App\Services\Data\UserDAO;

class SecurityService
{

    // Function takes user as an argument and calls the database registration service with that user then returns
    // the result it gets
    public function register(UserModel $user)
    {
        Log::info("Entering SecurityService.register()");

        $connection = new Connection();
        $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);

        $DAO = new UserDAO($connection);

        $result = $DAO->create($user);

        if ($result['result']) {
            $userID = $result['insertID'];

            // Creates instances of the business services having to do with user information
            $infoService = new UserInfoService();
            $addressService = new AddressService();

            // Creates new entries in information tables corresponding to the user with the new user's ID
            $infoResult = $infoService->createUserInfo($userID);
            $addressResult = $addressService->createAddress($userID);
            
            if($infoResult && $addressResult){
                $connection->commit();
            } else {
                $connection->rollBack();
            }
        }

        $connection = null;

        Log::info("Exiting SecurityService.register() with result: " . $result['result']);

        return $result;
    }

    // Function takes user as an argument and calls the database login service and returns the result
    public function login(LoginModel $user)
    {
        Log::info("Entering SecurityService.login()");

        $connection = new Connection();

        $DAO = new UserDAO($connection);

        $connection = null;

        $result = $DAO->findByLogin($user);

        Log::info("Exiting SecurityService.login() with result: " . $result['result']);

        // Stores all of the necessary information from the login in the session in the event of a successful login
        if ($result['result'] && $result['user']['STATUS']) {
            session([
                'ID' => $result['user']['IDUSERS']
            ]);
            session([
                'USERNAME' => $result['user']['USERNAME']
            ]);
            session([
                'NAME' => [
                    'FIRSTNAME' => $result['user']['FIRSTNAME'],
                    'LASTNAME' => $result['user']['LASTNAME']]]);
            session(['ROLE' => $result['user']['ROLE']]);
        }
        
        return $result;
    }
}