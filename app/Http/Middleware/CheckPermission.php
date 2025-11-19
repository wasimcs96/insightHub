<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission = null)
    {
        // dd('middleware reached');
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to access this page.');
        }

        $user = Auth::user();

        // Super admin bypass
        if ($user->hasRole('super-admin')) {
            return $next($request);
        }

        // If specific permission is provided, check for it
        // dd($permission);
        if ($permission) {
            if (!$user->hasPermission($permission)) {
                return $this->unauthorizedResponse($request);
            }
            return $next($request);
        }

        // Auto-detect permission based on route
        $routeName = Route::currentRouteName();
        $requiredPermission = $this->getPermissionFromRoute($routeName, $request->method());

        if ($requiredPermission && !$user->hasPermission($requiredPermission)) {
            return $this->unauthorizedResponse($request);
        }

        return $next($request);
    }

    /**
     * Get permission name from route name and HTTP method
     *
     * @param string $routeName
     * @param string $method
     * @return string|null
     */
    protected function getPermissionFromRoute($routeName, $method)
    {
        if (!$routeName) {
            return null;
        }

        // Map HTTP methods to permission actions
        $actionMap = [
            'GET' => 'view',
            'POST' => 'create',
            'PUT' => 'edit',
            'PATCH' => 'edit',
            'DELETE' => 'delete',
        ];

        // Extract base route name (remove action suffix if exists)
        $baseRoute = preg_replace('/\.(index|show|create|store|edit|update|destroy)$/', '', $routeName);
        
        // Convert route name to permission format
        // Example: insighthub.role-management.index -> role-management.view
        $parts = explode('.', $baseRoute);
        
        // Get the last meaningful part as the resource name
        $resourceName = end($parts);
        
        // Determine action based on route suffix or HTTP method
        $action = null;
        
        if (str_ends_with($routeName, '.index') || str_ends_with($routeName, '.show')) {
            $action = 'view';
        } elseif (str_ends_with($routeName, '.create') || str_ends_with($routeName, '.store')) {
            $action = 'create';
        } elseif (str_ends_with($routeName, '.edit') || str_ends_with($routeName, '.update')) {
            $action = 'edit';
        } elseif (str_ends_with($routeName, '.destroy')) {
            $action = 'delete';
        } else {
            $action = $actionMap[$method] ?? 'view';
        }

        return "{$resourceName}.{$action}";
    }

    /**
     * Return unauthorized response
     *
     * @param Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    protected function unauthorizedResponse($request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to access this resource.'
            ], 403);
        }

        return redirect()->back()->with('error', 'You do not have permission to access this resource.');
    }
}
