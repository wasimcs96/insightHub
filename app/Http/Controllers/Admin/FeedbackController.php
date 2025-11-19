<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'role' => 'required|string|max:255',
        'description' => 'required|string',
        'sector' => 'nullable|string', // Incoming field name
        'sub_sector' => 'nullable|string', // Incoming field name
        'json' => 'nullable|json', // Incoming field name
        'feedback' => 'required|boolean',
        'feedback_rating' => 'required|integer|min:1|max:5',
        'feedback_comment' => 'nullable|string',
    ]);

    // Map incoming fields to database columns
    $data = [
        'role' => $validated['role'],
        'description' => $validated['description'],
        'sector_name' => $validated['sector'] ?? null, // Map 'sector' to 'sector_name'
        'sub_sector_name' => $validated['sub_sector'] ?? null, // Map 'sub_sector' to 'sub_sector_name'
        'json_data' => $validated['json'] ?? null, // Map 'json' to 'json_data'
        'feedback' => $validated['feedback'],
        'feedback_rating' => $validated['feedback_rating'],
        'feedback_comment' => $validated['feedback_comment'] ?? null,
    ];

    Feedback::create($data);

    return response()->json(['success' => true, 'message' => 'Feedback stored successfully!']);
}

}
