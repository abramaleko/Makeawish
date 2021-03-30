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

    //get all the user requests
    public function request()
    {
         $wishes=Wishes::where('user_id',Auth::id())->orderBy('id','desc')->get();
        return view('request',['wishes'=> $wishes]);
    }

    public function Uploadrequest(Request $request )
    {
       $request->validate([
        'description' => 'required|string|max:255',
        'amount' => 'required|integer'
        ]);

        $ins= new Wishes();
        $ins->description=$request->description;
        $ins->amount=$request->amount;
        $ins->user_id=$request->user()->id;
        $ins->save();
        return redirect()->route('requests')->with('status','Request submitted successfully');
    }

    public function requestGrant($id)
    {
      $wish=Wishes::find($id);
      $wish->status="Granted";
      $wish->save();
      return back();
    }
}
