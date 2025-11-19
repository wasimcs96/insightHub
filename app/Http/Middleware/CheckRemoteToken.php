<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;

class CheckRemoteToken
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

    // $user = AuthController::checkUser();

    // if ($user) {
    if (auth()->user()) {

      // $request->merge(["user_id" => $user['id'], "role" => "admin"]);

      $request->merge(["user_id" => auth()->user()->id, "role" => "admin"]);
      
      $response = $next($request);

      return $response->header('Cache-Control', 'nocache, no-store, max-age=0, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('X-Frame-Options', 'SAMEORIGIN')
        ->header('Expires', 'Fri, 01 Jan 1990 00:00:00 GMT');
    } else {

      return redirect('/dashboard');
    }
  }
}
