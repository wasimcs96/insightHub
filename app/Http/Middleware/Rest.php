<?php

namespace App\Http\Middleware;

use App\Models\AccessKey;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Rest
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->header('X-API-KEY')) {

            return response()->json(['message' => 'Unauthenticated'], 401);
        }
        $key = $this->findKey($request->header('X-API-KEY'));

        if (!$key) {

            return response()->json(['message' => 'The authentication key is incorrect'], 401);
        }

        if ($key->ips) {

            if (!in_array($request->ip(), (array)$key->ips)) {

                return response()->json(['message' => 'Forbidden'], 403);
            }
        }

        if ($key->origins) {

            if (!in_array($request->header('origin'), (array)$key->origins)) {

                return response()->json(['message' => 'Forbidden'], 403);
            }
        }

        if ($key->https) {

            if (!$request->isSecure()) {

                return response()->json(['message' => 'Insecure connection'], 404);
            }
        }
        return $next($request);
    }


    /**
     * @param string $key
     * @return AccessKey|null
     */
    public function findKey(string $key): AccessKey|null
    {
        return AccessKey::where('key', hash('sha256', $key))->first();
    }
}
