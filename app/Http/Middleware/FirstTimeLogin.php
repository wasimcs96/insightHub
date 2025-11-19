<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FirstTimeLogin
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
        $user = auth()->user();
        // dd($request);
        if($user->first_time_login == 0){
            // dd($user);
            return redirect()->route('employee.about.me');

        } else {
         return $next($request);
        }
    }
}
