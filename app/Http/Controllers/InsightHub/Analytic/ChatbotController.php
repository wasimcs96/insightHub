<?php

namespace App\Http\Controllers\InsightHub\Analytic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Check if user is admin or company
        if (!auth()->user()->isAdmin() && !auth()->user()->isCompany()) {
            abort(403, 'Unauthorized access to InsightHub Chatbot Analytics');
        }

        $user = auth()->user();
        
        // You can add any additional data you want to pass to the view here
        $data = [
            'user' => $user,
            'title' => 'InsightHub Chatbot Analytics',
            // Add more data as needed
        ];

        return view('InsightHub.Analytic.chatbot', $data);
    }
    
}