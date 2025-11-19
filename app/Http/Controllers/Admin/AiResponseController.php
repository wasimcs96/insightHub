<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\ValidateAiResponseRequest;
use App\Services\AiResponseService;
use App\Http\Controllers\Controller;

class AiResponseController extends Controller
{
    protected $aiResponseService;

    public function __construct(AiResponseService $aiResponseService)
    {
        $this->aiResponseService = $aiResponseService;
    }

    public function validateAndSave(ValidateAiResponseRequest $request)
    {
        $aiResponse = $request->validated();

        try {
            $this->aiResponseService->processAiResponse($aiResponse);
            return response()->json([
                'message' => 'AI response validated and saved successfully.',
                'updatedResponse' => $aiResponse
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
