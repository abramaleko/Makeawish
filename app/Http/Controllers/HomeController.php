<?php

namespace App\Http\Controllers;

use App\Events\ReferenceMail;
use App\Events\WishGrantedMail;
use Illuminate\Http\Request;
use App\Models\Wishes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        if(Auth::user()->admin == true)
        {
            //get all wishes
            $wishes=Wishes::orderBy('id','desc')->get();

            $granted=Wishes::where('status','Granted')->count();
            return view('request',['wishes'=> $wishes,'granted'=>$granted]);
        }

        else
        {
            return view('request');
        }

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
         $mail_data=array(
             'name' => ucfirst($request->name),
             'email' => $request->email,
             'reference_code' => $reference_code
         );
         ReferenceMail::dispatch($mail_data);
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

    public function requestGrant(Request $request)
    {
      $wish=Wishes::find($request->id);

      //populates the array with the requestee name,grant_name,the grant_email and reference code
      $mail_data=array(
        'grant_name' => ucfirst($request->name),
        'email' => $wish->email,
        'name' => $wish->name,
        'reference_code' => $wish->reference_code
    );
    WishGrantedMail::dispatch($mail_data);

      $wish->status="Granted";
      $wish->grant_name=ucfirst($request->name);
      $wish->grant_email=$request->email;
      $wish->grant_phone_number=$request->phone_no;
      $wish->save();
      return back()->with('status','Congratulations on granting '.$wish->name.' request 🙏');
    }

    //get the searched wish
    public function getWish($id)
    {
       $wishes=Wishes::where('reference_code',$id)->get();
       return view('request',['wishes'=> $wishes]);
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

    //shows the my stats page
    public function stats()
    {
        return view('stats');
    }

    //searchs for the requestee_names
    public function requestee_names(Request $request)
    {
        $name =Wishes::query()
        ->select('name')
        ->where('name', 'LIKE', "%{$request->name}%")
        ->get();
        return response()->json($name);
    }

     //searchs for the request info
     public function requestInfo(Request $request)
     {
       $info=Wishes::select('name','amount','status','created_at')->where('name',$request->name)->orderBy('id','desc')->get();
       $granted=Wishes::where('name',$request->name)->where('status','Granted')->count();
        $data=array([
            'info' => $info,
             'granted' =>$granted
        ]);
       return json_encode($data);
     }
}
