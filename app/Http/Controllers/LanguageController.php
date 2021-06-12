<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{

    //set locale
       public function setLanguage(Request $request , $lang)
       {
           session()->put('lang',$lang);
           return redirect()->back();
       }
}
