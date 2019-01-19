<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 1-20-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    //Function recives user registration input, creates a connection to the database and attempts to create a new entry
    //in the users table
    public function index(Request $request)
    {
        //Get user input from request
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $email = $request->input('email');
        $uname = $request->input('uname');
        $pword = $request->input('pword');

        //Connect to database
        $connection = new \mysqli('localhost', 'root', 'root', 'laravelCLC');

        if ($connection) {

            //Prepare insert statement for security
            $statement = $connection->prepare("INSERT INTO `Users` (`idUsers`, `Username`, `Password`, `Email`, `FirstName`, `LastName`) VALUES (NULL, ?, ?, ?, ?, ?)");

            //Bind user input to prepaired statement
            $statement->bind_param("sssss", $fname, $lname, $email, $uname, $pword);

            $statement->execute();

            //Send user to registration success page if sql statement affected a row
            if ($statement->affected_rows != 0) {
                return view('registerSuccess');
            }
        }
        //Send user to registration failure page if unable to establish connection to database or unable create an entry
        return view('registerFail');
    }
}
