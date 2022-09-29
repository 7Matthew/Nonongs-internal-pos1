<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            //admin role == 0 
            //user role == 1  
            if( Auth::user()->role == '0'){
               return $next($request);
            } 
            else{
                return redirect('/menu')->with('message', 'Access Denied!');
            }
        }
        else {
            return redirect('/')->with('message', 'You need to log-in!');
        }
        return $next($request);
    }
}