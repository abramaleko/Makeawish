<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishes;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $wishes=Wishes::where('status','Pending')->orderBy('id','desc')->paginate(3);
        return view('home',['wishes'=> $wishes]);
    }

    //get the requests page
    public function request()
    {
        return view('request');
    }


    //uploads the user request
    public function Uploadrequest(Request $request )
    {
       $request->validate([
         'name' =>  'required',
         'email' => 'required|email',
         'phone_no' => 'required|string',
        'description' => 'required|string|max:255',
        'amount' => 'required|integer'
        ]);
         $reference_code=mt_rand(100000,999000);
        $ins= new Wishes();
        $ins->reference_code=$reference_code;
        $ins->name=ucfirst($request->name);
        $ins->email=$request->email;
        $ins->phone_number=$request->phone_no;
        $ins->description=$request->description;
        $ins->amount=$request->amount;
        $ins->save();
        return redirect()->route('requests')->with('status','Your reference number for the submitted request is '.$reference_code);
    }

    public function requestGrant($id)
    {
      $wish=Wishes::find($id);
      $wish->status="Granted";
      $wish->save();
      return back();
    }

    //get the searched wish
    public function getWish(Request $request)
    {
       $wish=Wishes::where('reference_code',$request->reference_code)->first();
       return view('request',['wish'=> $wish]);
    }

    //updates the request
    public function updateRequest(Request $request)
    {
        $wish=Wishes::find($request->wish_id);
        $wish->name=ucfirst($request->name);
        $wish->email=$request->email;
        $wish->phone_number=$request->phone_no;
        $wish->description=$request->description;
        $wish->amount=$request->amount;
        $wish->save();
        return redirect()->route('requests')->with('status','Request updated successfully');
    }

    public function deleteRequest($id)
    {
        $wish=Wishes::find($id);
        $wish->forceDelete();

        return redirect()->route('requests')->with('status','Request deleted successfully');

    }
}
