<?php

namespace App\Http\Controllers;

use App\Events\DeclineMail;
use App\Events\ReferenceMail;
use App\Models\Wishes;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //assigns auth middleware to the constructor
    public function __construct()
    {
      $this->middleware('auth');
    }

    //shows all the wishes that needs to be approved
    public function adminStatus()
    {
        $wishes=Wishes::orderBy('id','desc')->get();
        return view('admin-status',['wishes' => $wishes]);
    }

    //approves wish request
    public function approveRequest($id)
    {
      $wish=Wishes::find($id);
      $mail_data=array(
        'name' => ucfirst($wish->name),
        'email' => $wish->email,
        'reference_code' => $wish->reference_code ,
    );

     try {

        ReferenceMail::dispatch($mail_data);
     }
     catch (\Swift_TransportException $th) {
         //catch if the no internet connection
         return redirect()->route('admin-status')->with('error',__('Failed to approve').$wish->name.__(' wish please check your internet connection and try again'));
     }
        $wish->status= "Pending wish";
         $wish->save();
      return redirect()->route('admin-status')->with('status',__('You have successfully approve ').$wish->name. __(' wish') );
    }

    public function declineRequest(Request $request)
    {
       $request->validate([
               'decline_reason' => 'required|string',
           ]
       );
       $wish=Wishes::find($request->wish_id);
       $mail_data=array(
        'name' => ucfirst($wish->name),
        'email' => $wish->email,
        'reference_code' => $wish->reference_code ,
    );
       try {
        DeclineMail::dispatch($mail_data);
       } catch (\Swift_TransportException $th) {
         //catch if the error in internet connection
        return redirect()->route('admin-status')->with('error',__('Failed to decline ').$wish->name.__(' wish please check your internet connection and try again'));
    }

       $wish->decline_reason=$request->decline_reason;
       $wish->status= 'Declined';
       $wish->save();

       return redirect()->route('admin-status')->with('status',__('A note with decline note has been sent to the requestee email'));
    }

    //shows all the wishes submitted
    public function wishData()
    {
        $all_wishes=Wishes::orderBy('id','desc')->get();
        $granted=Wishes::where('status','Granted')->count();
        return view('wish-data',['all_wishes'=> $all_wishes,'granted'=>$granted]);
    }


}
