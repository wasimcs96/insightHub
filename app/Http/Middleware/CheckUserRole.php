<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        $allowedRoles = ['super-admin', 'tenant-admin', 'company-admin', 'admin'];
        if (
            !$user ||
            !$user->role ||
            !in_array($user->role->name, $allowedRoles)
        ) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}