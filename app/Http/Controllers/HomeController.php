<?php

namespace App\Http\Controllers;



use App\Events\NewRequest;
use App\Events\WishGrantedMail;
use App\Exports\WishesExport;
use Illuminate\Http\Request;
use App\Models\Wishes;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use PDF;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    //shows all wishes
    public function wishes()
    {
        $wishes=Wishes::where('status','Pending wish')->orderBy('id','desc')->paginate(3);
        return view('wishes',['wishes'=> $wishes]);
    }

    public function status()
    {
        $all_wishes=Wishes::orderBy('id','desc')->get();
        $granted=Wishes::where('status','Granted')->count();
        return view('status',['all_wishes'=> $all_wishes,'granted'=>$granted]);
    }
       //get the searched wish
       public function getWish($id)
       {
          $wishes=Wishes::where('reference_code',$id)->get();
          $all_wishes=Wishes::orderBy('id','desc')->get();
          $granted=Wishes::where('status','Granted')->count();
          return view('status',['wishes'=> $wishes,'all_wishes'=> $all_wishes,'granted'=>$granted]);
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
         'employee_code' => 'required',
        'description' => 'required|string|max:255',
        'amount' => 'nullable|integer'
        ]);
         $reference_code=mt_rand(100000,999000);
         $ins= new Wishes();

         $mail_data=array(
            'name' => ucfirst($request->name),
            'email' => $request->email,
            'reference_code' => $reference_code ,
        );
        try {

            NewRequest::dispatch($mail_data);
         }
         catch (\Swift_TransportException $th) {
             //catch if the no internet connection
             return redirect()->route('wishes')->with('error','Failed to submit your wish please check your internet connection and try again.');
         }
         $ins->reference_code=$reference_code;
         $ins->name=ucfirst($request->name);
         $ins->email=$request->email;
         $ins->phone_number=$request->phone_no;
         $ins->employee_code=$request->employee_code;
         $ins->description=$request->description;
         $ins->amount=$request->amount;
         $ins->save();
         return redirect()->route('wishes')->with('status','Your reference number is '.$reference_code. ' and you will be notified once your request is approved');
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
    try {
        WishGrantedMail::dispatch($mail_data);
    } catch (\Swift_TransportException $th) {
         //catch if the error in internet connection
         return back()->with('error','Failed to grant '.$wish->name.' wish please check your internet connection and try again.');
    }

      $wish->status="Granted";
      $wish->grant_name=ucfirst($request->name);
      $wish->grant_email=$request->email;
      $wish->grant_phone_number=$request->phone_no;
      $wish->save();
      return back()->with('status','Thank you for fulfilling'.$wish->name.' wish 🙏');
    }



    //updates the wish
    public function updateRequest(Request $request)
    {
        $request->validate([
            'name' =>  'required',
            'email' => 'required|email',
            'phone_no' => 'required|string',
            'employee_code' => 'required',
           'description' => 'required|string|max:255',
           'amount' => 'required|integer'
           ]);

        $wish=Wishes::find($request->wish_id);
        $wish->name=ucfirst($request->name);
        $wish->email=$request->email;
        $wish->phone_number=$request->phone_no;
        $wish->description=$request->description;
        $wish->amount=$request->amount;
        $wish->save();
        return redirect()->route('status')->with('status','Request updated successfully');
    }

    public function deleteRequest($id)
    {
        $wish=Wishes::find($id);
        $wish->forceDelete();
        if (Auth::check())
        //if admin is loged in
        return redirect()->route('admin-status')->with('status','Request deleted successfully');
        else
        return redirect()->route('status')->with('status','Request deleted successfully');
    }


    public function filterWishes(Request $request)
    {
      switch($request->filter)
      {
          case '1':
            $wishes=Wishes::orderBy('id','desc')->get();
            $granted=Wishes::where('status','Granted')->count();
            //return if to admin wish data if user is loged in
            if (Auth::check())
                return view('wish-data',['all_wishes'=> $wishes,'granted'=>$granted]);
            else
            //if user is not loged in then return to common user page
            return view('status',['all_wishes'=> $wishes,'granted'=>$granted]);
            break;
           case '2':
            $wishes=Wishes::orderBy('amount','desc')->get();
            $granted=Wishes::where('status','Granted')->count();
             //return if to admin wish data if user is loged in
             if (Auth::check())
             return view('wish-data',['all_wishes'=> $wishes,'granted'=>$granted]);
            else
            //if user is not loged in then return to common user page
            return view('status',['all_wishes'=> $wishes,'granted'=>$granted]);
            break;
            case '3':
                $wishes=Wishes::orderBy('amount','asc')->get();
                $granted=Wishes::where('status','Granted')->count();
                 //return if to admin wish data if user is loged in
                if (Auth::check())
                return view('wish-data',['all_wishes'=> $wishes,'granted'=>$granted]);
                else
                //if user is not loged in then return to common user page
                return view('status',['all_wishes'=> $wishes,'granted'=>$granted]);
                break;
                case '4':
                    $wishes=Wishes::where('status','Granted')->get();
                    $granted=Wishes::where('status','Granted')->count();
                     //return if to admin wish data if user is loged in
                    if (Auth::check())
                    return view('wish-data',['all_wishes'=> $wishes,'granted'=>$granted]);
                    else
                    //if user is not loged in then return to common user page
                    return view('status',['all_wishes'=> $wishes,'granted'=>$granted]);
                    break;
                  case '5':
                    $wishes=Wishes::where('status','Pending wish')->get();
                    $granted=Wishes::where('status','Granted')->count();
                     //return if to admin wish data if user is loged in
                    if (Auth::check())
                    return view('wish-data',['all_wishes'=> $wishes,'granted'=>$granted]);
                    else
                    //if user is not loged in then return to common user page
                    return view('status',['all_wishes'=> $wishes,'granted'=>$granted]);
                    break;
                     case '6':
                        $wishes=Wishes::latest()->get();
                        $granted=Wishes::where('status','Granted')->count();
                         //return if to admin wish data if user is loged in
                        if (Auth::check())
                        return view('wish-data',['all_wishes'=> $wishes,'granted'=>$granted]);
                        else
                        //if user is not loged in then return to common user page
                    return view('status',['all_wishes'=> $wishes,'granted'=>$granted]);
                        break;
                         default:
                         {
                            return redirect()->back();
                         }
      }
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

     public function requestPdf()
     {
        $wishes=Wishes::orderBy('id','desc')->get();

        $granted=Wishes::where('status','Granted')->count();

        $pdf = PDF::loadView('pdf.wishes',compact('wishes','granted'));

        return $pdf->stream('wishes.pdf');
     }

     public function requestExcel()
     {
        return Excel::download(new WishesExport, 'wishes.xlsx');
     }

     //shows the contact page
     public function contactUs()
     {
         return view('contact');
     }
}
