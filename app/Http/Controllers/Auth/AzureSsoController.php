<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TenantManager;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AzureSsoController extends Controller
{
    public function __construct(protected TenantManager $tenantManager) {}

    public function redirect()
    {
        return Socialite::driver('azure')
            ->stateless()
            ->redirect();
    }

    public function callback()
    {
        try {
            $azureUser = Socialite::driver('azure')->stateless()->user();
            
            // Extract tenant info from Azure claims
            $tenantId = $this->extractTenantFromAzure($azureUser);
            
            $user = User::updateOrCreate([
                'email' => $azureUser->getEmail(),
            ], [
                'name' => $azureUser->getName(),
                'tenant_id' => $tenantId,
                'azure_id' => $azureUser->getId(),
                'avatar' => $azureUser->getAvatar(),
            ]);

            Auth::login($user);
            
            // Tenant context will be set by the Login event listener
            
            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'SSO authentication failed');
        }
    }

    protected function extractTenantFromAzure($azureUser): ?int
    {
        // Example: Extract from custom claims
        $claims = $azureUser->user ?? [];
        
        if (isset($claims['extension_TenantId'])) {
            return $claims['extension_TenantId'];
        }

        // Or map from organization
        if (isset($claims['tid'])) {
            return \App\Models\Tenant::where('azure_tenant_id', $claims['tid'])->value('id');
        }

        return null;
    }
}