<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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

            // Use preg_match to check if the value matches the pattern
            return preg_match($pattern, $value) === 1;
        });

        Validator::replacer('mobile', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'Invalid format. Correct format is "+94XXXXXXXXX".');
        });

        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'year'=>'required|numeric|digits:4',
            'mobile'=>'required|mobile',
            "scnum"=>'required|scnumber|unique:registers,r_scnum',
            'email' => 'required|email|unique:registers,r_email',
            'workplace'=>'required',
            'role'=>'required',
            'position'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $fname = $request->input("fname");
        $lname = $request->input("lname");
        $year = $request->input("year");
        $mobile = $request->input("mobile");
        $scnum = $request->input("scnum");
        $email = $request->input("email");
        $workplace = $request->input("workplace");
        $role = $request->input("role");

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
        }else $imgpath = null;


        $registers = new Register();
        $registers->r_fname = $fname;
        $registers->r_lname = $lname;
        $registers->r_year = $year;
        $registers->r_mobile = $mobile;
        $registers->r_scnum = $scnum;
        $registers->r_email = $email;
        $registers->r_workplace = $workplace;
        $registers->r_role = $role;
        $registers->r_position = $position;
        $registers->r_imgpath = $imgpath;
        $registers->save();
        /*$result = DB::statement("insert into registers(r_fname,r_lname,r_year,r_mobile,r_scnum,r_email,r_workplace,r_role,r_position)
                                 values(?,?,?,?,?,?,?,?,?)",
                                [$fname,$lname,$year,$mobile,$scnum,$email,$workplace,$role,$position]);*/
        return redirect()->back()->with('success', 'Registered successfully!');


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
        $data = Register::all();
        return view('adminaccept', compact('data'));
    }
}
