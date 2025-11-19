<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *   title="Insight Access APIs",
 *   version="1.0.0",
 *   description="REST API for Insight Access modules."
 * )
 *
 * @OA\Server(
 *   url="http://127.0.0.1:8002",
 *   description="Local"
 * )
 * @OA\Server(
 *   url="https://https://dev-ph-base.theinsightaccess.com",
 *   description="Base PH Dev"
 * )
 *
 * @OA\SecurityScheme(
 *   securityScheme="ApiKeyAuth",
 *   type="apiKey",
 *   in="header",
 *   name="x-api-key",
 *   description="Project API Key sent in request header."
 * )
 */
class OpenApi {} // class can be empty; file just holds the annotations
