<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;


class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $experiences=Experience::orderBy('id','desc')->paginate(3);
        return view('experience',['experiences'=> $experiences]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validates the request
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'description' => 'required|string'
        ]);

        //stores the info
        Experience::create([
            'name' => $request->name,
             'email' => $request->email,
            'description' => $request->description
        ]);

        return redirect()->route('experience.index')->with('status','Thanks for sharing your experience with us');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Experience::destroy($id);
       return redirect()->back()->with('status','Feedback deleted successfully');
    }
}
