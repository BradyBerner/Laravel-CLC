<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 1-20-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //Function recieves user login input, creates a connection to the database and checks user input against
    //database entries
    public function index(Request $request)
    {
        //Get user form input from request
        $username = $request->input('uname');
        $password = $request->input('pword');

        //Connect to database
        $connection = new \mysqli('localhost', 'root', 'root', 'laravelCLC');
        
        if ($connection) {
            //Prepare selection statement for security
            $statement = $connection->prepare("SELECT * FROM `Users` WHERE `Username` = ? AND `Password` = ?");
        
            //Bind user input to select statement
            $statement->bind_param("ss", $username, $password);
            
            $statement->execute();
            
            $result = $statement->get_result();
        
            //Send user to login success page if we get a result from the database
            if ($result->num_rows != 0) {
                return view('loginSuccess');
            }
        }
        //Send user to login fail page if we can't connect to the database or don't get any results back
        return view('loginFail');
    }
}
