<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $validator=Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email',
            'description' => 'required|string',
             'photo' => 'required|image|max:3063',
        ],
        $messages=[
          'max' => 'The photo must not be larger than 3 Mb',
        ]);
        if ($validator->passes()) {

        //  stores the image attachment
         $path = $request->file('photo')->store('public/experiment_attachments');
         $path = $request->file('photo')->store(
            'experiment_attachments', 'public'
        );

        Experience::create([
            'name' => $request->name,
             'email' => $request->email,
             'description' => $request->description,
             'photo_attachment' => $path,

        ]);
        return response()->json(['success'=>__('Thanks for sharing your experience with us')]);
        }

        return response()->json(['error'=>$validator->errors()->all()]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $delete = Experience::find($id);

       Storage::disk('public')->delete($delete->photo_attachment);   //delete the attachment
       $delete->delete();

       return redirect()->back()->with('status',__('Feedback deleted successfully'));
    }
}
