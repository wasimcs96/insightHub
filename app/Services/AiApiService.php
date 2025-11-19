<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiApiService
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = config('services.ai_api.base_url');
        $this->token = config('services.ai_api.token');
    }

    public function get(string $endpoint, array $queryParams = [])
    {
        try {
            $response = Http::get($this->baseUrl . $endpoint, $queryParams);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('AI API GET Request Failed', [
                'endpoint' => $endpoint,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('Exception during AI API GET Request', [
                'endpoint' => $endpoint,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    /**
     * Handle POST requests to the AI API.
     *
     * @param string $endpoint
     * @param array $payload
     * @return array|false
     */
    public function post(string $endpoint, array $payload = [])
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'x-api-token' => $this->token,
            ])->post($this->baseUrl . $endpoint, $payload);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('AI API POST Request Failed', [
                'endpoint' => $endpoint,
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('Exception during AI API POST Request', [
                'endpoint' => $endpoint,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }

    public function getSectors()
    {
        return $this->get('/api/v0/jd-selector/sectors');
    }

    public function getTracksBySector(string $sector)
    {
        $params = ['sector' => $sector];
        return $this->get('/api/v0/jd-selector/tracks', $params);
    }

    public function getRolesByTrack(string $sector, string $track)
    {
        $params = ['sector' => $sector, 'track' => $track];
        return $this->get('/api/v0/jd-selector/roles', $params);
    }

    public function getRoleDetails(string $sector, string $track, string $role)
    {
        $params = ['sector' => $sector, 'track' => $track, 'role' => $role];
        return $this->get('/api/v0/jd-selector/role-details', $params);
    }

    public function getSkillsBySectorAndTrack(string $sector, string $skillType = 'any')
    {
        $params = ['sector' => $sector, 'type' => $skillType];
        return $this->get('/api/v0/jd-selector/skills', $params);
    }

    public function getSkillDetails(string $sector, string $skill, string $track, string $skillType)
    {
        $params = ['sector' => $sector, 'skill' => $skill, 'track' => $track, 'type' => $skillType];
        return $this->get('/api/v0/jd-selector/skills-details', $params);
    }

    /**
     * Fetch AI-generated JD data using POST method.
     *
     * @param array $data
     * @return array|false
     */
    public function getAiGenratedJdData(array $data)
    {
        $endpoint = '/api/v0/jd-generator';
        return $this->post($endpoint, $data);
    }
    /**
     * Send feedback rating to the AI API.
     *
     * @param array $payload
     * @return array|false
     */
    public function sendFeedbackRating(array $payload)
    {
        return $this->post('/feedback', $payload);
    }
}
