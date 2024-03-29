<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Http\Controllers;

use App\Services\Utility\ILoggerService;
use Illuminate\Http\Request;
use App\Services\Business\SearchService;

/**
 * Class JobSearchController
 * @package App\Http\Controllers
 */
class JobSearchController extends Controller
{
    /**
     * Handles the user's search
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request, ILoggerService $logger){
        
        $logger->info("Entering JobSearchController.index()");

        try{
            //Validates the user's search
            $this->validateSearch($request);
        } catch (\Exception $e) {
            return view('jobSearchResults')->with(['jobs' => []]);
        }
        
        try{
            //Appends % to the beginning and end of the user's search
            $searchString = "%" . $request->input('searchString') . "%";
            
            $service = new SearchService();
            
            $results = $service->JobSearch($searchString, $logger);
            
            $data = ['jobs' => $results];
            
            return view('jobSearchResults')->with($data);
        } catch (\Exception $e){
            $logger->error("Exception occured in JobSearchController.index(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateSearch(Request $request){
        $rules = [
            'searchString' => 'Required | Between:4,30'
        ];
        
        $this->validate($request, $rules);
    }
}
