<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/jc-diamond/app/Http/Controllers/Api/UserController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenant_id' => 'required|integer|exists:tenants,id',
            'status' => 'nullable|in:active,inactive,suspended',
            'page' => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Set tenant context
            session(['tenant_id' => $request->tenant_id]);

            $query = User::with(['roles', 'tenant', 'department']);

            // Filter by status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            } else {
                $query->where('status', 'active');
            }

            $users = $query->paginate($request->get('per_page', 50));

            Log::info('API: Users fetched', [
                'service' => $request->attributes->get('api_service'),
                'tenant_id' => $request->tenant_id,
                'count' => $users->total()
            ]);

            return response()->json([
                'success' => true,
                'data' => $users->items(),
                'pagination' => [
                    'current_page' => $users->currentPage(),
                    'per_page' => $users->perPage(),
                    'total' => $users->total(),
                    'last_page' => $users->lastPage()
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('API: Users fetch failed', [
                'service' => $request->attributes->get('api_service'),
                'tenant_id' => $request->tenant_id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch users'
            ], 500);
        }
    }

    public function show(Request $request, $id)
    {
        $validator = Validator::make(['tenant_id' => $request->tenant_id], [
            'tenant_id' => 'required|integer|exists:tenants,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Tenant ID is required',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Set tenant context
            session(['tenant_id' => $request->tenant_id]);

            $user = User::with(['roles.permissions', 'tenant', 'department', 'manager'])
                ->find($id);
            
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found'
                ], 404);
            }

            // Verify user belongs to the requested tenant
            if ($user->tenant_id != $request->tenant_id) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found in specified tenant'
                ], 404);
            }

            Log::info('API: User details fetched', [
                'service' => $request->attributes->get('api_service'),
                'user_id' => $id,
                'tenant_id' => $request->tenant_id
            ]);

            return response()->json([
                'success' => true,
                'data' => $user
            ]);

        } catch (\Exception $e) {
            Log::error('API: User fetch failed', [
                'service' => $request->attributes->get('api_service'),
                'user_id' => $id,
                'tenant_id' => $request->tenant_id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch user'
            ], 500);
        }
    }

    public function validateAccess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'tenant_id' => 'required|integer|exists:tenants,id', 
            'permission' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Set tenant context
            session(['tenant_id' => $request->tenant_id]);

            $user = User::with(['roles.permissions'])
                ->where('id', $request->user_id)
                ->where('status', 'active')
                ->first();

            if (!$user) {
                return response()->json([
                    'success' => true,
                    'access' => false,
                    'message' => 'User not found or inactive'
                ]);
            }

            // Verify user belongs to the requested tenant
            if ($user->tenant_id != $request->tenant_id) {
                return response()->json([
                    'success' => true,
                    'access' => false,
                    'message' => 'User not found in specified tenant'
                ]);
            }

            // Check if user has the specific permission
            $hasPermission = $user->hasPermissionTo($request->permission);

            Log::info('API: User access validated', [
                'service' => $request->attributes->get('api_service'),
                'user_id' => $request->user_id,
                'tenant_id' => $request->tenant_id,
                'permission' => $request->permission,
                'access' => $hasPermission
            ]);

            return response()->json([
                'success' => true,
                'access' => $hasPermission,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'tenant_id' => $user->tenant_id,
                    'roles' => $user->roles->pluck('name')
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('API: Access validation failed', [
                'service' => $request->attributes->get('api_service'),
                'user_id' => $request->user_id,
                'tenant_id' => $request->tenant_id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to validate access'
            ], 500);
        }
    }
}