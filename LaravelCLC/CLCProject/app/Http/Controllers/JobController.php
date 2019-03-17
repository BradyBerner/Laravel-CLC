<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\JobModel;
use App\Services\Business\JobService;
use App\Services\Utility\MyLogger;
use App\Services\Business\JobApplicantService;

class JobController extends Controller
{
    
    /**
     * Handles the user's viewing of a job
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request){
        try{
            MyLogger::getLogger()->info("Entering JobController.index()");
            
            $jobID = $request->input('jobID');
            
            $jobService = new JobService();
            
            $result = $jobService->getJob($jobID);
            $applied = false;
            
            if(Session::has('ID')){
                $applicantService = new JobApplicantService();
                $applicants = $applicantService->getAllApplicants($jobID);
                
                foreach($applicants as $applicant){
                    if($applicant['USERS_IDUSERS'] == Session::get('ID')){
                        $applied = true;
                    }
                }
            }
            
            $data = ['job' => $result, 'applied' => $applied];
            
            MyLogger::getLogger()->addInfo("Exiting JobController.index()");
            
            return view('viewJob')->with($data);
        } catch (\Exception $e){
            MyLogger::getLogger()->error("Exception occurred in JobController.inswz(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }

    // Function recives user registration input, uses it to create a job object and then uses that object
    // to attempt to create a new database entry
    public function createJob(Request $request)
    {
        MyLogger::getLogger()->info("Entering JobController.createJob()");
        
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
            
            MyLogger::getLogger()->info("Exiting JobController.createJob() with a result of " . $result['result']);

            //Returns the user to the job admin page
            return view('jobAdmin')->with(['results' => $jobService->getAllJobs()]);
        } catch (\Exception $e) {
            MyLogger::getLogger()->error("Exception occured in JobController.createJob(): " . $e->getMessage());
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
            'description' => 'Required | Between:1,65535'
        ];
        
        $this->validate($request, $rules);
    }
    
    public function apply(Request $request){
        
        MyLogger::getLogger()->info("Entering JobController.apply()");
        
        try{
            
            $userID = $request->input('userID');
            $jobID = $request->input('jobID');
            
            $applicantService = new JobApplicantService();
            
            $result = $applicantService->apply($jobID, $userID);
            
            MyLogger::getLogger()->info("Exiting JobController.apply()", [$result]);
            
            $data = [];
            
            $data['message'] = $result ? "You successfully applied for the job" : "Something went wrong with your application";
            $data['messageType'] = $result ? "success" : "danger";
            
            return view('home')->with($data);
        } catch (\Exception $e){
            MyLogger::getLogger()->error("Exception occured in JobController.apply(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    public function cancelApplication(Request $request){
        
        MyLogger::getLogger()->info("Entering JobController.cancelApplication()");
        
        try{
            
            $userID = $request->input('userID');
            $jobID = $request->input('jobID');
            
            $applicantService = new JobApplicantService();
            
            $result = $applicantService->cancelApplication($jobID, $userID);
            
            MyLogger::getLogger()->info("Exiting JobController.cancelApplication()", [$result]);
            
            $data = [];
            
            $data['message'] = $result ? "Your application was canceled successfully" : "Something went wrong with the cancelation process";
            $data['messageType'] = $result ? "success" : "danger";
            
            return view('home')->with($data);
        } catch (\Exception $e){
            MyLogger::getLogger()->error("Exception occured in JobController.cancelApplication(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
}
