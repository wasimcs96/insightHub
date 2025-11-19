<?php

namespace App\Services;

use NeverBounce\Single;
use NeverBounce\Auth;
use Exception;

class NeverBounceService
{
    private $apiKey;
    private $apiURL;
    public function __construct()
    {
        $this->apiKey = env('NEVERBOUNCE_API_KEY');
        $this->apiURL = env('NEVERBOUNCE_API_URL');
        if (!$this->apiKey) {
            throw new \Exception("API key is missing");
        }
        Auth::setApiKey($this->apiKey);
    }


    /**
     * Validate a single email using NeverBounce API.
     *
     * @param string $email
     * @return array
     */
    public function validateEmail($email)
    {
        try {
            $result = Single::check($email);
            if (empty($result)) {
                throw new Exception("Received an empty response from Single::check");
            }
            return json_decode(json_encode($result), true);
        } catch (Exception $e) {
            throw new Exception("Failed to validate email: " . $e->getMessage());
        }
    }

    public function validateEmailWithGuzzle($email)
    {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->post($this->apiURL.'v4/single/check', [
                'form_params' => [
                    'email' => $email,
                    'key' => $this->apiKey,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (Exception $e) {
            throw new Exception("Failed to validate email with Guzzle: " . $e->getMessage());
        }
    }
}