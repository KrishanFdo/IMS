<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Mail\RemoveMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Exception;

class UserController extends Controller
{
    public function accept(Request $request){
        $mail_data = [];
        $id = $request->input('id');
        $u = Register::where('r_id',$id)->first(); //$u is user to be accepted

        $mail_data['message'] = "You registration has been accepted. Here your username and password for Alumna-DCS";
        $mail_data['username'] = $u->r_email;
        $mail_data['password'] = Str::random(8);

        $user = new User();
        $user->fname = $u->r_fname;
        $user->lname = $u->r_lname;
        $user->eyear = $u->r_eyear;
        $user->pyear = $u->r_pyear;
        $user->mobile = $u->r_mobile;
        $user->wmobile = $u->r_wmobile;
        $user->scnum = $u->r_scnum;
        $user->email = $u->r_email;
        $user->workplace = $u->r_workplace;
        $user->role = $u->r_role;
        $user->position = $u->r_position;
        $user->qualifications = $u->r_qualifications;
        $user->country = $u->r_country;
        $user->imgpath = $u->r_imgpath;
        $user->password = Hash::make($mail_data['password']);
        $user->save();
        try{
            Mail::to($user->email)->send(new RegisterMail($mail_data));
            Register::where('r_id',$id)->delete();
        }
        catch(Exception $e){
            User::where('scnum',$u->r_scnum)->delete();
            return redirect()->back()->with('mailerror', 'Accepting Unsuccessful! Network Error or any other error');
        }

        return redirect()->back()->with('success', 'User Accepted Successfully');

    }


    public function users(){
        $data = User::all();
        return view('users', compact('data'));
    }

    public function members(){
        $data = User::all();
        return view('members', compact('data'));
    }

    public function delete_user(Request $request){
        $id = $request->input('id');
        $user = User::where('id',$id)->first();
        $email = $user->email;
        $name = $user->fname;
        try{
            Mail::to($email)->send(new RemoveMail($name));
            User::where('id',$id)->delete();
            if (File::exists('storage/'.$user->imgpath)) {
                if($user->imgpath != 'images/default.png')
                    File::delete('storage/'.$user->imgpath);
            }

        }
        catch(Exception $e){
            return redirect()->back()->with('mailerror', 'Removal Unsuccessful! Network Error or any other error');
        }

        return redirect()->back()->with('success', 'User Removed successfully.');

    }
}
