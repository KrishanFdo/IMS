<?php

namespace App\Http\Controllers;

use App\Mail\RegisterFormMail;
use App\Models\Register;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;

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

        $request->validate([
            'role'=>'required',
            'country'=>'required'
        ]);
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

        $recipientEmails = $users->pluck('email')->implode(',');
        //dd($recipientEmails);

        $gmailUrl = "https://mail.google.com/mail/u/0/?view=cm&to={$recipientEmails}";

        return redirect()->away($gmailUrl);
    }
}
