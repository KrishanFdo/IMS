<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
            return str_replace(':attribute', $attribute, 'Invalid format. It should be in the format "SC/YYYY/NNNNN".');
        });

        $request->validate([
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as per your requirements.
            'email' => 'required|email|unique:registers,r_email',
            'fname'=>'required',
            'lname'=>'required',
            'year'=>'required',
            'mobile'=>'required',
            "scnum"=>'required|scnumber|unique:registers,r_scnum',
            'workplace'=>'required',
            'role'=>'required',
            'position'=>'required'
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


        $result = DB::statement("insert into registers(r_fname,r_lname,r_year,r_mobile,r_scnum,r_email,r_workplace,r_role,r_position)
                                 values(?,?,?,?,?,?,?,?,?)",
                                [$fname,$lname,$year,$mobile,$scnum,$email,$workplace,$role,$position]);
        return redirect()->back()->with('success', 'Registered successfully!');


    }
}
