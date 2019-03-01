<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Services\Utility\ViewData;
use App\Models\AffinityGroupModel;
use App\Services\Business\AffinityGroupService;

class AffinityGroupController extends Controller
{
    
    public function index(Request $request){
        
        Log::info("Entering AffinityGroupController.index()");
        
        try{
            $userID = $request->input('ID');
            
            Log::info("Exiting AffinityGroupController.index()");
            
            return view('groups')->with(ViewData::getAffinityData($userID));
        } catch (\Exception $e){
            Log::error("Exception occured in AffinityGroupController.index(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    public function newGroup(Request $request){
        
        Log::info("Entering AffinityGroupController.newGroup()");
        
        $this->validateGroupInput($request);
        
        try{
            $group = new AffinityGroupModel(-1, $request->input('name'), $request->input('description'), $request->input('focus'), $request->input('ID'));
            
            $service = new AffinityGroupService();
            
            $results = $service->createGroup($group);
            
            Log::info("Exiting AffinityGroupController.newGroup() with a result of " . $results);
            
            return view('groups')->with(ViewData::getAffinityData($group->getUserID()));
        } catch (\Exception $e){
            Log::error("Exception occured in AffinityGroupController.newGroup(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    public function editGroup(Request $request){
        
        Log::info("Entering AffinityGroupController.editGroup()");
        
        $this->validateGroupInput($request);
        
        try{
            $group = new AffinityGroupModel($request->input('ID'), $request->input('name'), $request->input('description'), $request->input('focus'), 0);
            
            $service = new AffinityGroupService();
            
            $results = $service->editGroup($group);
            
            Log::info("Exiting AffinityGroupController.editGroup() with a result of " . $results);
            
            return view('groups')->with(ViewData::getAffinityData($request->session()->get('ID')));
        } catch (\Exception $e){
            Log::error("Exception occured in AffinityGroupController.newGroup(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    private function validateGroupInput(Request $request){
        $rules = [
            'name' => ['Required', Rule::unique('AFFINITYGROUPS', 'NAME')->where(function ($query){
            return $query->where('USERS_IDUSERS', Session::get('ID'));
            })],
            'description' => 'Required',
            'focus' => 'Required'
        ];
        
        $this->validate($request, $rules);
    }
    
    public function deleteGroup(Request $request){
        
        Log::info("Entering AffinityGroupController.deleteGroup()");
        
        try{
            $id = $request->input('groupID');
            
            $service = new AffinityGroupService();
            
            $results = $service->deleteGroup($id);
            
            Log::info("Exiting AffinityGroupController.deleteGroup() with a result of " . $results);
            
            return view('groups')->with(ViewData::getAffinityData($request->session()->get('ID')));
        } catch (\Exception $e){
            Log::error("Exception occured in AffinityGroupController.newGroup(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
}
