<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function accept(Request $request){
        $mail_data = [];
        $id = $request->input('id');
        $u = Register::where('r_id',$id)->first(); //$u is user to be accepted

        $mail_data['message'] = "You registration has been accepted. Here your username and password for IMS";
        $mail_data['username'] = $u->r_email;
        $mail_data['password'] = Str::random(8);

        $user = new User();
        $user->fname = $u->r_fname;
        $user->lname = $u->r_lname;
        $user->year = $u->r_year;
        $user->mobile = $u->r_mobile;
        $user->scnum = $u->r_scnum;
        $user->email = $u->r_email;
        $user->workplace = $u->r_workplace;
        $user->role = $u->r_role;
        $user->position = $u->r_position;
        $user->imgpath = $u->r_imgpath;
        $user->password = Hash::make($mail_data['password']);
        $user->save();

        Register::where('r_id',$id)->delete();

        Mail::to($user->email)->send(new RegisterMail($mail_data));
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
        if (File::exists('storage/'.$user->imgpath)) {
            if($user->imgpath != 'images/default.png')
                File::delete('storage/'.$user->imgpath);
        }
        User::where('id',$id)->delete();
        return redirect()->back()->with('success', 'User Removed successfully.');

    }
}
