<?php

namespace App\Http\Controllers;

use App\Mail\ThanksMails;
use App\Models\Wishes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class ThanksController extends Controller
{
    //

    public function index()
    {
        return view('grants-mail');
    }

    public function sendMail(Request $request)
    {
       $request->validate([
            "mail" => 'required|string|max:2000'
       ]);

       $recipients=Wishes::where('status','Granted')->select('grant_email')->get();


       foreach ($recipients as $recipient) {
            Mail::to($recipient->grant_email)->send(new ThanksMails($request->mail));
    }

    return back()->with('success','Mail sent successfully');

    }
}
