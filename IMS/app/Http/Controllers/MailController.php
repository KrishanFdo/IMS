<?php

namespace App\Http\Controllers;

use App\Models\Register;
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
}
