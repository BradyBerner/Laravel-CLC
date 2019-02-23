<?php
/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 2-10-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use App\Services\Business\UserInfoService;
use App\Services\Business\AddressService;
use App\Models\UserInfoModel;
use App\Models\AddressModel;
use App\Services\Business\EducationService;
use App\Models\EducationModel;
use App\Services\Business\ExperienceService;
use App\Models\ExperienceModel;
use App\Models\SkillModel;
use App\Services\Business\SkillService;

class UserEditController extends Controller
{
    // Takes user input from the previous form and passes it along so that a user can edit their info in the database
    public function editUserInfo(Request $request)
    {
        Log::info("Entering UserEditController.editUserInfo()");

        // Validates the user's input against pre-defined rules
        $this->validateInfoInput($request);

        try {

            // Gets all of the input from the previous form and uses it to create a new user info object
            $info = new UserInfoModel(0, $request->input('description'), $request->input('phone'), $request->input('age'), $request->input('gender'), $request->input('userID'));

            // Creates instance of the appropriate business service
            $service = new UserInfoService();

            // Stores the result of the database query to edit the user's info according to the info in the model passed
            $results = $service->editUserInfo($info);

            Log::info("Exiting UserEditController.editUserInfo() with a result of " . $results);

            return redirect()->action('UserProfileController@index', ['ID' => $request->session()->get('ID')]);
        } catch (\Exception $e) {
            Log::error("Exception occurred in UserEditController.editUserInfo(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }

    // Method contains rules for validating user info input before submitting it to the database
    private function validateInfoInput(Request $request)
    {
        $rules = [
            'phone' => 'Numeric',
            'age' => 'Numeric',
            'gender' => 'Alpha'
        ];

        $this->validate($request, $rules);
    }

    // Takes user input from the previous form and passes it along so that a user can edit their address in the database
    public function editAddress(Request $request)
    {
        Log::info("Entering UserEditController.editAddress()");

        // Validates the user's input against pre-defined rules
        $this->validateAddressInput($request);
        
        try {

            // Gets all of the input from the previous form and uses it to create a new address object
            $address = new AddressModel(0, $request->input('street'), $request->input('city'), $request->input('state'), $request->input('zip'), $request->input('userID'));

            // Creates instance of the appropriate business service
            $service = new AddressService();

            // Stores the result of the database query to edit the user's address according to the info in the model passed
            $results = $service->editAddress($address);

            Log::info("Exiting UserEditController.editAddress() with a result of " . $results);

            return redirect()->action('UserProfileController@index', ['ID' => $request->session()->get('ID')]);
        } catch (\Exception $e) {
            Log::error("Exception occurred in UserEditController.editAddress(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }

    // Method contains rules for validating address input before submitting it to the database
    private function validateAddressInput(Request $request)
    {
        $rules = [
            'street' => 'Required',
            'city' => 'Required | Alpha',
            'state' => 'Required | Alpha',
            'zip' => 'Required | Numeric'
        ];
        
        $this->validate($request, $rules);
    }
    
    public function removeEducation(Request $request){
        
        Log::info("Entering UserEditController.removeEducation()");
        
        try{
            $id = $request->input('ID');
            
            $service = new EducationService();
            
            $results = $service->remove($id);
            
            Log::info("Exiting UserEditController.removeEducation() with a result of " . $results);
            
            return redirect()->action('UserProfileController@index', ['ID' => $request->session()->get('ID')]);
        } catch (\Exception $e){
            Log::error("Exception occured in UserEditController.removeEducation(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    public function addEducation(Request $request){
        Log::info("Entering UserEditController.addEducation()");
        
        $this->validateEducationInput($request);
        
        try{
            $education = new EducationModel(-1, $request->input('school'), $request->input('degree'), $request->input('field'), $request->input('gpa'), $request->input('startyear'), $request->input('endyear'), $request->input('userID'));
            
            $service = new EducationService();
            
            $results = $service->create($education);
            
            Log::info("Exiting UserEditController.addEducation() with a result of " . $results);
            
            return redirect()->action('UserProfileController@index', ['ID' => $request->session()->get('ID')]);
        } catch (\Exception $e){
            Log::error("Exception occurred in UserEditController.editEducation(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    public function editEducation(Request $request){
        Log::info("Entering UserEditController.editEducation()");
        
        $this->validateEducationInput($request);
        
        try{
            $education = new EducationModel($request->input('id'), $request->input('school'), $request->input('degree'), $request->input('field'), $request->input('gpa'), $request->input('startyear'), $request->input('endyear'), -1);
            
            $service = new EducationService();
            
            $results = $service->update($education);
            
            Log::info("Exiting UserEditController.editEducation() with a result of " . $results);
            
            return redirect()->action('UserProfileController@index', ['ID' => $request->session()->get('ID')]);
        } catch (\Exception $e){
            Log::error("Exception occurred in UserEditController.editEducation(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    private function validateEducationInput(Request $request){
        $rules = [
            'school' => 'Required',
            'degree' => 'Required',
            'field' => 'Required',
            'gpa' => 'Required | Numeric',
            'startyear' => 'Required | Numeric',
            'endyear' => 'Required | Numeric'
        ];
        
        $this->validate($request, $rules);
    }
    
    public function removeExperience(Request $request){
        
        Log::info("Entering UserEditController.removeExperience()");
        
        try{
            $id = $request->input('ID');
            
            $service = new ExperienceService();
            
            $results = $service->remove($id);
            
            Log::info("Exiting UserEditController.removeExperience() with a result of " . $results);
            
            return redirect()->action('UserProfileController@index', ['ID' => $request->session()->get('ID')]);
        } catch (\Exception $e){
            Log::error("Exception occured in UserEditController.removeExperience(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    public function addExperience(Request $request){
        
        Log::info("Entering UserEditController.addExperience()");
        
        $this->validateExperienceInput($request);
        
        try{
            $experience = new ExperienceModel(-1, $request->input('title'), $request->input('company'), $request->input('current'), $request->input('startyear'), $request->input('endyear'), $request->input('description'), $request->input('userID'));
            
            $service = new ExperienceService();
            
            $results = $service->create($experience);
            
            Log::info("Exiting UserEditController.addExperience() with a result of " . $results);
            
            return redirect()->action('UserProfileController@index', ['ID' => $request->session()->get('ID')]);
        } catch (\Exception $e){
            Log::error("Exception occured in UserEditController.addExperience(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    public function editExperience (Request $request){
        
        Log::info("Entering UserEditController.editExperience()");
        
        $this->validateExperienceInput($request);
        
        try{
            $experience = new ExperienceModel($request->input('id'), $request->input('title'), $request->input('company'), $request->input('current'), $request->input('startyear'), $request->input('endyear'), $request->input('description'), -1);
            
            $service = new ExperienceService();
            
            $results = $service->update($experience);
            
            Log::info("Exiting UserEditController.editExperience() with a result of " . $results);
            
            return redirect()->action('UserProfileController@index', ['ID' => $request->session()->get('ID')]);
        } catch (\Exception $e){
            Log::error("Exception occured in UserEditController.addExperience(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    private function validateExperienceInput(Request $request){
        $rules = [
            'title' => 'Required',
            'company' => 'Required',
            'current' => 'Required | Numeric',
            'startyear' => 'Required | Numeric',
            'endyear' => $request->input('endyear') != null ? 'Numeric' : ''
        ];
        
        $this->validate($request, $rules);
    }
    
    public function addSkill(Request $request){
        
        Log::info("Entering UserEditController.addSkill()");
        
        $this->validateSkillInput($request);
        
        try{
            $skill = new SkillModel(-1, $request->input('skill'), $request->input('description'), $request->input('userID'));
            
            $service = new SkillService();
            
            $results = $service->create($skill);
            
            Log::info("Exiting UserEditController.addSkill() with a result of " . $results);
            
            return redirect()->action('UserProfileController@index', ['ID' => $request->session()->get('ID')]);
        } catch (\Exception $e){
            Log::error("Exception occured in UserEditController.addSkill(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
    
    private function validateSkillInput(Request $request){
        $rules = [
            'skill' => ['Required', Rule::unique('SKILLS', 'SKILL')->where(function ($query){ 
                return $query->where('USERS_IDUSERS', Session::get('ID'));
            })],
            'description' => 'Required | Alpha_Dash'
        ];
        
        $this->validate($request, $rules);
    }
    
    public function removeSkill(Request $request){
        
        Log::info("Entering UserEditController.removeSkill()");
        
        try{
            $id = $request->input('ID');
            
            $service = new SkillService();
            
            $results = $service->remove($id);
            
            Log::info("Exiting UserEditController.removeSkill() with a result of " . $results);
            
            return redirect()->action('UserProfileController@index', ['ID' => $request->session()->get('ID')]);
        } catch (\Exception $e){
            Log::error("Exception occured in UserEditController.removeSkill(): " . $e->getMessage());
            $data = ['error_message' => $e->getMessage()];
            return view('error')->with($data);
        }
    }
}
