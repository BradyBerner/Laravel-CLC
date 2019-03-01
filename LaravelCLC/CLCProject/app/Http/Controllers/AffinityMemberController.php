<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Business\AffinityMemberService;
use App\Services\Utility\ViewData;

class AffinityMemberController extends Controller
{
    public function joinGroup(Request $request){
        
        Log::info("Entering AffinityMemberController.joinGroup()");
        
        try{
            $userID = $request->input('userID');
            $groupID = $request->input('groupID');
            
            $service = new AffinityMemberService();
            
            $results = $service->joinGroup($userID, $groupID);
            
            Log::info("Exiting AffinityMemberController.joinGroup() with a result of " . $results);
            
            return view('groups')->with(ViewData::getAffinityData($userID));
        } catch (\Exception $e){
            Log::error("Exception occured in AffinityMemberController.joinGroup(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    public function leaveGroup(Request $request){
        
        Log::info("Entering AffinityMemberController.leaveGroup()");
        
        try{
            $userID = $request->input('userID');
            $groupID = $request->input('groupID');
            
            $service = new AffinityMemberService();
            
            $results = $service->leaveGroup($userID, $groupID);
            
            Log::info("Exiting AffinityMemberController.leaveGroup() with a result of " . $results);
            
            return view('groups')->with(ViewData::getAffinityData($userID));
        } catch(\Exception $e){
            Log::error("Exception occured in AffinityMemberController.leaveGroup(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
}
