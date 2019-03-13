<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Utility\MyLogger;
use App\Services\Business\SearchService;

class JobSearchController extends Controller
{
    public function index(Request $request){
        
        MyLogger::getLogger()->info("Entering JobSearchController.index()");
        
        try{
            $this->validateSearch($request);
        } catch (\Exception $e) {
            return view('jobSearchResults')->with(['jobs' => []]);
        }
        
        try{
            $searchString = "%" . $request->input('searchString') . "%";
            
            $service = new SearchService();
            
            $results = $service->JobSearch($searchString);
            
            $data = ['jobs' => $results];
            
            return view('jobSearchResults')->with($data);
        } catch (\Exception $e){
            MyLogger::getLogger()->error("Exception occured in JobSearchController.index(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    private function validateSearch(Request $request){
        $rules = [
            'searchString' => 'Required'
        ];
        
        $this->validate($request, $rules);
    }
}
