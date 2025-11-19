<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheckMiddleware
{
    public function handle($request, Closure $next)
    {

        if (auth()->user()->isAdmin() || auth()->user()->isCompany() || auth()->user()->isTalentAcquisition() || auth()->user()->isDepartment()) {

            // return redirect()->route('admin.dashboard');
        return $next($request);

        }
        else{
            return redirect()->route('employee.dashboard');

        }


    }
}
