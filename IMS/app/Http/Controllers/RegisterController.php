<?php

namespace App\Http\Controllers;

use App\Mail\RegisterFormMail;
use App\Mail\RemoveMail;
use App\Models\Register;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    function register(Request $request){

        Validator::extend('scnumber', function ($attribute, $value, $parameters, $validator) {
            // Define the pattern for the custom code (SC/Year/Digits)
            $pattern = '/^SC\/\d{4}\/\d{4,5}$/';

            // Use preg_match to check if the value matches the pattern
            return preg_match($pattern, $value) === 1;
        });

        Validator::replacer('scnumber', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Invalid format. Correct format is "SC/YYYY/NNNNN".');
        });

        Validator::extend('mobile', function ($attribute, $value, $parameters, $validator) {
            // Define the pattern for the custom code (SC/Year/Digits)
            $pattern = '/^\+94\d{9}$/';
            $pattern2 = '/^0\d{9}$/';
            // Use preg_match to check if the value matches the pattern
            return preg_match($pattern, $value) || preg_match($pattern2, $value);
        });

        Validator::replacer('mobile', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Invalid format. Correct format is "+94XXXXXXXXX".');
        });

       $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'eyear'=>'required|numeric|digits:4',
            'pyear'=>'required|numeric|digits:4',
            'mobile'=>'required|mobile',
            'wmobile'=>'required|mobile',
            "scnum"=>'required|scnumber|unique:registers,r_scnum|unique:users,scnum',
            'email' => 'required|email|unique:registers,r_email|unique:users,email',
            'workplace'=>'required',
            'role'=>'required',
            'position'=>'required',
            'country'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'employees'=>'required'
        ]);

        $fname = $request->input("fname");
        $lname = $request->input("lname");
        $eyear = $request->input("eyear");
        $pyear = $request->input("pyear");
        $mobile = $request->input("mobile");
        $wmobile = $request->input("wmobile");
        $scnum = $request->input("scnum");
        $email = $request->input("email");
        $workplace = $request->input("workplace");
        $role = $request->input("role");
        $qualifications = $request->input("qualifications");
        $country = $request->input("country");
        $employees = $request->input("employees");

        if($request->input("position")=="Other")
            $position = $request->input("other-position");
        else
            $position = $request->input("position");

        if ($request->hasFile('image')){
            $image = $request->file('image');
            $originalName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $filename = $this->generateUniqueFilename($originalName, $extension);

            // Store the file in the 'public' disk
            $imgpath = $image->storeAs('images',$filename,'public');
        }else $imgpath = 'images/default.png';

        $qual=$request->input("qualifications",[]);
        $qualifications = "";
        foreach($qual as $q){
            $qualifications .= $q . ",";
        }

        $registers = new Register();
        $registers->r_fname = $fname;
        $registers->r_lname = $lname;
        $registers->r_eyear = $eyear;
        $registers->r_pyear = $pyear;
        $registers->r_mobile = $mobile;
        $registers->r_wmobile = $wmobile;
        $registers->r_scnum = $scnum;
        $registers->r_email = $email;
        $registers->r_workplace = $workplace;
        $registers->r_role = $role;
        $registers->r_position = $position;
        $registers->r_qualifications = $qualifications;
        $registers->r_country = $country;
        $registers->r_imgpath = $imgpath;
        $registers->r_employees = $employees;
        $registers->save();

        try{
            Mail::to($registers->r_email)->send(new RegisterFormMail($registers->r_fname));
        }
        catch(Exception $e){
            $reg = Register::where('r_scnum',$scnum)->first();
            if (File::exists('storage/'.$reg->r_imgpath)) {
                if($reg->r_imgpath != 'images/default.png')
                    File::delete('storage/'.$reg->r_imgpath);
            }
            Register::where('r_scnum',$scnum)->delete();
            return redirect()->back()->with('mailerror', 'Registration Unsuccessful! Network Error or any other error');
        }

        return redirect()->back()->with('success', 'Registered successfully! Check your Email-Inbox');


    }

    private function generateUniqueFilename($originalName, $extension)
    {
        // You can use various strategies here to generate a unique filename
        // For example, appending a timestamp or a random string to the original name.
        $filename = pathinfo($originalName, PATHINFO_FILENAME);
        $filename = Str::slug($filename); // Convert to a URL-friendly slug
        $filename = $filename . '_' . time() . '.' . $extension;

        return $filename;
    }

    public function admin_accept(){
        $selectedrole = "";
        $selectedscnum = "";
        $selectedposition = "All";
        $selectedworkplace = "All";
        $selectedcountry = "";
        $data = Register::all();
        $roles = Register::distinct()->pluck('r_role');
        $positions = Register::distinct()->pluck('r_position');
        $workplaces = Register::distinct()->pluck('r_workplace');
        $countries = Register::distinct()->pluck('r_country');
        $scnums=[];
        $scnumbers = Register::distinct()->pluck('r_scnum');
        foreach($scnumbers as $scnum){
            $scParts = explode('/', $scnum);
            if(!in_array($scParts[1],$scnums))
                array_push($scnums,$scParts[1]);
        }
        return view('adminaccept',
         compact('data','roles','positions','workplaces','scnums', 'countries',
         'selectedrole','selectedscnum','selectedposition','selectedworkplace','selectedcountry'));
    }

    public function delete_register(Request $request){
        $id = $request->input('id');
        $reg = Register::where('r_id',$id)->first();
        $email = $reg->r_email;
        $name = $reg->r_fname;
        try{
            Mail::to($email)->send(new RemoveMail($name));
            Register::where('r_id',$id)->delete();
            if (File::exists('storage/'.$reg->r_imgpath)) {
                if($reg->r_imgpath != 'images/default.png')
                    File::delete('storage/'.$reg->r_imgpath);
            }
        }
        catch(Exception $e){
            return redirect()->back()->with('mailerror', 'Removal Unsuccessful! Network Error or any other error');
        }



        return redirect()->back()->with('success', 'Record Removed successfully.');

    }

    public function filtered_registers(Request $request)
    {
        $query = Register::query();
        $flag=0;
        // Apply filters based on user selections
        $selectedrole = $request->input('role');
        $selectedscnum = $request->input('scnumber');
        $selectedposition = $request->input('position');
        $selectedworkplace = $request->input('workplace');
        $selectedcountry = $request->input('country');

        if ($request->has('role')) {
            if($request->input('role')!=""){
                $query->where('r_role', $request->input('role'));
                $flag = 1;
            }
        }

        if ($request->has('position')) {
            if($request->input('position')!="All"){
                $query->where('r_position', $request->input('position'));
                $flag = 1;
            }
        }

        if ($request->has('workplace')) {
            if($request->input('workplace')!="All"){
                $query->where('r_workplace', $request->input('workplace'));
                $flag = 1;
            }
        }

        if ($request->has('country')) {
            if($request->input('country')!=""){
                $query->where('r_country', $request->input('country'));
                $flag = 1;
            }
        }

        // Add more conditions for other filters (position, workplace, qualifications)

        $data = $query->get();

        if ($request->has('scnumber')) {
            if($request->input('scnumber')!=""){
                foreach($data as $key=>$user){
                    $scParts = explode('/', $user['r_scnum']);
                    if($request->input('scnumber')!=$scParts[1]){
                        unset($data[$key]);
                    }
                }
                $flag = 1;
            }
        }

        if($flag==0){
            $data=Register::all();
        }

        $scnums=[];
        $scnumbers = Register::distinct()->pluck('r_scnum');
        foreach($scnumbers as $scnum){
            $scParts = explode('/', $scnum);
            if(!in_array($scParts[1],$scnums))
                array_push($scnums,$scParts[1]);
        }
        $roles = Register::distinct()->pluck('r_role');
        $positions = Register::distinct()->pluck('r_position');
        $workplaces = Register::distinct()->pluck('r_workplace');
        $countries = Register::distinct()->pluck('r_country');
        return view('adminaccept',
         compact('data','roles','positions','workplaces','scnums','countries',
         'selectedrole','selectedscnum','selectedposition','selectedworkplace','selectedcountry'));
    }

}
