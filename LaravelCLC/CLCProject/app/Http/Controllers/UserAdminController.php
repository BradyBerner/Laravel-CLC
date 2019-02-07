<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Business\UserService;
use App\Models\UserModel;

class UserAdminController extends Controller
{
    public function index(){
        
        Log::info("Entering UserAdminController.index()");
        
        $service = new UserService();
        
        $results = $service->getAllUsers();
        
        $data = ['results' => $results];
        
        Log::info("Exiting UserAdminController.index()");
        
        return view('userAdmin')->with($data);
    }
    
    public function editUser(Request $request){
        
        Log::info("Entering UserAdminController.editUser()");
        
        $this->validateEdit($request);
        
        $user = new UserModel($request->input('id'), $request->input('username'), $request->input('password'), $request->input('email'), $request->input('firstname'), $request->input('lastname'), $request->input('status'), $request->input('role'));
        
        $service = new UserService();
        
        $results = $service->editUser($user);
        
        Log::info("Exiting UserAdminController.editUser()");
        
        //TODO:: add redirect to error page
        if($results){
            return redirect('/userAdmin');
        }
    }
    
    private function validateEdit(Request $request){
        $rules = [
            'username' => 'Required | Between:4,10', 
            'password' => 'Required | Between:4,10',
            'email' => 'Required | email',
            'firstname' => 'Required | Between:4,10 | Alpha',
            'lastname' => 'Required | Between:4,10 | Alpha'
        ];
        
        $this->validate($request, $rules);
    }
    
    public function removeUser(Request $request){
        
        Log::info("Entering UserAdminController.removeUser()");
        
        $id = $request->input('id');
        
        $service = new UserService();
        
        $results = $service->removeUser($id);
        
        Log::info("Exiting UserAdminController.removeUser()");
        
        //TODO:: add redirect to error page
        if($results){
            return redirect('/userAdmin');
        }
    }
}
