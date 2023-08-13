<?php

namespace App\Http\Controllers;

use App\Mail\CustomMail;
use App\Mail\RegisterFormMail;
use App\Models\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use Exception;

class MailController extends Controller
{
    public function send_accept_mail(Request $request){
        $mail_data = [];
        $id = $request->input('id');
        $user = Register::where('r_id',$id)->first();
        $mail_data['message'] = "You registration has been accepted. Here your username and password for IMS";
        $mail_data['username'] = $user->r_email;
        $mail_data['password'] = Str::random(8);

        Mail::to($user->r_email)->send(new RegisterMail($mail_data));

        return redirect()->back()->with('success', 'User Accepted Successfully');
    }

    public function send_register_mail(Request $request){
        $id = $request->input('id');
        $user = Register::where('r_id',$id)->first();

        Mail::to($user->r_email)->send(new RegisterFormMail($user->r_fname));

        return redirect()->back()->with('success', 'User Accepted Successfully');
    }

    public function sendmail(Request $request){
        $mail_data = [];
        $mail_users = [];
        $request->validate([
            'batch'=>'required',
            'role'=>'required',
            'country'=>'required',
            'subject'=>'required',
            'content'=>'required',
        ]);
        $mail_data['subject'] = $request->input('subject');
        $mail_data['content'] = $request->input('content');
        $batch = $request->input('batch');
        $role = $request->input('role');
        $country = $request->input('country');

        if($role =='all' && $country == 'all'){
            $users = User::all();
        }
        else if($role =='all')
            $users = User::where('country', $country)->get();
        else if($country == 'all')
            $users = User::where('role', $role)->get();
        else{
            $users = User::where('role', $role)
                ->where('country', $country)
                ->get();
        }
        if($batch != 'all'){
            foreach($users as $user){
                $scParts = explode('/', $user->scnum);
                $scYear = $scParts[1];
                if($scYear == $batch){
                    array_push($mail_users,$user);
                }
            }
        }
        else
            $mail_users = $users;

        foreach($mail_users as $user){
            $mail_data['user'] = $user;
            try{
                Mail::to($user->email)->send(new CustomMail($mail_data));
            }
            catch(Exception $e){
                return redirect()->back()->with('mailerror', 'Emails were not sent. Network error or any other error');
            }
        }

        return redirect()->back()->with('success', 'Emails sent successfully');
    }
}
