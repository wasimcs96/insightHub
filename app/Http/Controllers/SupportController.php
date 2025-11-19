<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function redirectToSupport()
    {
        $user = Auth::user();

        // Generate an SSO token for the customer support system
        $ssoToken = $this->generateSsoToken($user);

        // Redirect to the customer support system with the SSO token
        $supportUrl = 'https://customer-support.example.com/sso-login';
        return redirect()->away($supportUrl . '?sso_token=' . $ssoToken);
    }

    private function generateSsoToken($user)
    {
        $secretKey = env('SSO_SECRET_KEY', 'your-secret-key');
        $payload = [
            'user_id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'timestamp' => now()->timestamp,
        ];

        $signature = hash_hmac('sha256', json_encode($payload), $secretKey);
        $payload['signature'] = $signature;

        return base64_encode(json_encode($payload));
    }
}
