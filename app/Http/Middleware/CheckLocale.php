<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;

use Closure;
use Illuminate\Http\Request;
class CheckLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // $response = $next($request);
        // dd(session('lang'));
        if (session()->has('lang')) {
          App::setLocale(session('lang'));
        }
        else
        {
           App::setLocale(config('app.locale'));
        }
         return $next($request);

    }
}
