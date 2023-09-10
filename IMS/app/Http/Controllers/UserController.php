<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use App\Mail\RemoveMail;
use App\Mail\UserPasswordChange;
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
        $user->employees = $u->r_employees;
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
        $selectedrole = "";
        $selectedscnum = "";
        $selectedposition = "All";
        $selectedworkplace = "All";
        $selectedcountry = "";
        $selectedqualification = "";
        $users = User::all();
        $roles = User::distinct()->pluck('role');
        $positions = User::distinct()->pluck('position');
        $workplaces = User::distinct()->pluck('workplace');
        $countries = User::distinct()->pluck('country');
        $scnums=[];
        $scnumbers = User::distinct()->pluck('scnum');
        foreach($scnumbers as $scnum){
            $scParts = explode('/', $scnum);
            if(!in_array($scParts[1],$scnums))
                array_push($scnums,$scParts[1]);
        }
        return view('users',
         compact('users','roles','positions','workplaces','scnums', 'countries',
         'selectedrole','selectedscnum','selectedposition','selectedworkplace','selectedcountry','selectedqualification'));
    }

    public function members(){
        $selectedrole = "";
        $selectedscnum = "";
        $selectedposition = "All";
        $selectedworkplace = "All";
        $selectedcountry = "";
        $selectedqualification = "";
        $users = User::all();
        $roles = User::distinct()->pluck('role');
        $positions = User::distinct()->pluck('position');
        $workplaces = User::distinct()->pluck('workplace');
        $countries = User::distinct()->pluck('country');
        $scnums=[];
        $scnumbers = User::distinct()->pluck('scnum');
        foreach($scnumbers as $scnum){
            $scParts = explode('/', $scnum);
            if(!in_array($scParts[1],$scnums))
                array_push($scnums,$scParts[1]);
        }
        return view('members',
         compact('users','roles','positions','workplaces','scnums', 'countries',
         'selectedrole','selectedscnum','selectedposition','selectedworkplace','selectedcountry','selectedqualification'));
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

    public function filtered_users(Request $request)
    {
        $query = User::query();
        $flag=0;
        // Apply filters based on user selections
        $selectedrole = $request->input('role');
        $selectedscnum = $request->input('scnumber');
        $selectedposition = $request->input('position');
        $selectedworkplace = $request->input('workplace');
        $selectedcountry = $request->input('country');
        $selectedqualification = $request->input('qualification');

        if ($request->has('role')) {
            if($request->input('role')!=""){
                $query->where('role', $request->input('role'));
                $flag = 1;
            }
        }

        if ($request->has('position')) {
            if($request->input('position')!="All"){
                $query->where('position', $request->input('position'));
                $flag = 1;
            }
        }

        if ($request->has('workplace')) {
            if($request->input('workplace')!="All"){
                $query->where('workplace', $request->input('workplace'));
                $flag = 1;
            }
        }

        if ($request->has('country')) {
            if($request->input('country')!=""){
                $query->where('country', $request->input('country'));
                $flag = 1;
            }
        }

        // Add more conditions for other filters (position, workplace, qualifications)

        $users = $query->get();

        if ($request->has('scnumber')) {
            if($request->input('scnumber')!=""){
                foreach($users as $key=>$user){
                    $scParts = explode('/', $user['scnum']);
                    if($request->input('scnumber')!=$scParts[1]){
                        unset($users[$key]);
                    }
                }
                $flag = 1;
            }
        }

        if ($request->has('qualification')) {
            if($request->input('qualification')!=""){
                foreach($users as $key=>$user){
                    if(empty($user['qualifications'])){
                        unset($users[$key]);
                    }
                    else{
                        $qualifications = explode(',', $user['qualifications']);
                        if(!in_array($selectedqualification, $qualifications)){
                            unset($users[$key]);
                        }
                    }

                }
                $flag = 1;
            }
        }

        if($flag==0){
            $users=User::all();
        }

        $scnums=[];
        $scnumbers = User::distinct()->pluck('scnum');
        foreach($scnumbers as $scnum){
            $scParts = explode('/', $scnum);
            if(!in_array($scParts[1],$scnums))
                array_push($scnums,$scParts[1]);
        }
        $roles = User::distinct()->pluck('role');
        $positions = User::distinct()->pluck('position');
        $workplaces = User::distinct()->pluck('workplace');
        $countries = User::distinct()->pluck('country');
        return view('users',
         compact('users','roles','positions','workplaces','scnums','countries',
         'selectedrole','selectedscnum','selectedposition','selectedworkplace','selectedcountry','selectedqualification'));
    }

    public function filtered_members(Request $request)
    {
        $query = User::query();
        $flag=0;
        // Apply filters based on user selections
        $selectedrole = $request->input('role');
        $selectedscnum = $request->input('scnumber');
        $selectedposition = $request->input('position');
        $selectedworkplace = $request->input('workplace');
        $selectedcountry = $request->input('country');
        $selectedqualification = $request->input('qualification');

        if ($request->has('role')) {
            if($request->input('role')!=""){
                $query->where('role', $request->input('role'));
                $flag = 1;
            }
        }

        if ($request->has('position')) {
            if($request->input('position')!="All"){
                $query->where('position', $request->input('position'));
                $flag = 1;
            }
        }

        if ($request->has('workplace')) {
            if($request->input('workplace')!="All"){
                $query->where('workplace', $request->input('workplace'));
                $flag = 1;
            }
        }

        if ($request->has('country')) {
            if($request->input('country')!=""){
                $query->where('country', $request->input('country'));
                $flag = 1;
            }
        }

        // Add more conditions for other filters (position, workplace, qualifications)

        $users = $query->get();

        if ($request->has('scnumber')) {
            if($request->input('scnumber')!=""){
                foreach($users as $key=>$user){
                    $scParts = explode('/', $user['scnum']);
                    if($request->input('scnumber')!=$scParts[1]){
                        unset($users[$key]);
                    }
                }
                $flag = 1;
            }
        }

        if ($request->has('qualification')) {
            if($request->input('qualification')!=""){
                foreach($users as $key=>$user){
                    if(empty($user['qualifications'])){
                        unset($users[$key]);
                    }
                    else{
                        $qualifications = explode(',', $user['qualifications']);
                        if(!in_array($selectedqualification, $qualifications)){
                            unset($users[$key]);
                        }
                    }

                }
                $flag = 1;
            }
        }

        if($flag==0){
            $users=User::all();
        }
        $scnums=[];
        $scnumbers = User::distinct()->pluck('scnum');
        foreach($scnumbers as $scnum){
            $scParts = explode('/', $scnum);
            if(!in_array($scParts[1],$scnums))
                array_push($scnums,$scParts[1]);
        }
        $roles = User::distinct()->pluck('role');
        $positions = User::distinct()->pluck('position');
        $workplaces = User::distinct()->pluck('workplace');
        $countries = User::distinct()->pluck('country');
        return view('members',
         compact('users','roles','positions','workplaces','scnums','countries',
         'selectedrole','selectedscnum','selectedposition','selectedworkplace','selectedcountry','selectedqualification'));
    }


    public function update_user_password(Request $request){
        $request->validate([
            'new_password' => 'confirmed',
        ]);

        $user = Auth::user();

        $id = $request->input('id');
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');

        if(!Hash::check($old_password,$user->password))
            return redirect()->back()->with('error', 'Old Password is Incorrect.');

        // $u is the user object used to update password
        $u = User::find($id);
        $u->password = Hash::make($new_password);

        try{
            Mail::to($u->email)->send(new UserPasswordChange($u->fname));
        }
        catch(Exception $e){
            return redirect()->back()->with('mailerror', 'Unsuccessful! Network Error or any other error');
        }
        $u->save();

        return redirect()->back()->with('success', 'Password Changed successfully.');
    }

}
