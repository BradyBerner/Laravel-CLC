<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-3-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobModel;
use App\Services\Business\JobService;
use App\Services\Utility\MyLogger;

class JobController extends Controller
{

    // Function recives user registration input, uses it to create a job object and then uses that object
    // to attempt to create a new database entry
    public function createJob(Request $request)
    {
        MyLogger::getLogger()->info("Entering NewJobController.index()");
        
        // Validates the user's input against pre-defined rules
        $this->validateForm($request);
        
        try {

            // Takes user input from register form and uses it to make a new jobmodel object with an id of 0
            $job = new JobModel(0, $request->input('title'), $request->input('company'), $request->input('state'), $request->input('city'), $request->input('description'));

            // Creates instance of job service
            $jobService = new JobService();

            // Stores the result of the function call
            $result = $jobService->newJob($job);

            $data = [
                'result' => $result['result']
            ];
            
            MyLogger::getLogger()->info("Exiting NewJobController.index() with a result of " . $result['result']);

            //Returns the user to the job admin page
            return redirect('/jobAdmin');
            return view('jobAdmin')->with(['results' => $jobService->getAllJobs()]);
        } catch (\Exception $e) {
            MyLogger::getLogger()->error("Exception occurred in NewJobController.index(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }

    // Contains the rules for validating the job creation
    private function validateForm(Request $request)
    {
        $rules = [
            'title' => 'Required | Between:4,20 | unique:mysql.JOBS,TITLE',
            'company' => 'Required | Between:1,45',
            'state' => 'Required | Between:1,20',
            'city' => 'Required | Between:1,20',
            'description' => 'Required | Between:0,45'
        ];
        
        $this->validate($request, $rules);
    }
}
