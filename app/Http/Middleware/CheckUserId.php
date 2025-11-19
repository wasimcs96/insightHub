<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;

class CheckUserId
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

    try {
      $userId = session('user_id') ?? auth()->user()->id;

      if($userId){
       return $next($request);
      } else {
       return redirect()->route('login');
      }
    } catch (\Throwable $th) {
      return redirect()->route('login');
    }

  }
}
