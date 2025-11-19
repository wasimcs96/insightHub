<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        

        if (auth()->user()->isAdmin()) {
           
            return redirect()->route('admin.dashboard');
        }elseif(auth()->user()->role_id == 10){
            return redirect()->route('home');
        }
        else{
            return $next($request);

        }

        // return redirect()->route('login');
    }
}
