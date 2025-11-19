<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;

class SetUserRoutePrefix
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
        // dd($request);
        $prefix = $request->user()->isEmployee() ? 'employee' : 'admin';
// dd($prefix);
        // Set the prefix parameter in the route
        $request->route()->setParameter('prefix', $prefix);

        return $next($request);

        // if ($request->user()) {
        //     $prefix = '';
        //     if (!$request->user()->isAdmin()) {

        //         if ($request->user()->isCompany()) {
        //             $prefix = 'company';
        //         } elseif ($request->user()->isDepartment()) {
        //             $prefix = 'department';
        //         }

        //     } else {

        //         $prefix = 'admin';

        //     }
        //     $route = $request->route();
        //     $currentUri = $route->uri();
        //     $newroute = $route->action['as'];

        // //   return redirect()->route($newroute,[$prefix]);

        // } else {
        //     return $next($request);
        // }

        // return $next($request);
    }
}
