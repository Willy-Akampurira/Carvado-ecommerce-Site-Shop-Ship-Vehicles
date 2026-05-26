<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Display the main admin dashboard with AI-generated insights.
     */
    public function index(): \Illuminate\View\View
    {
        $this->authorizeAdmin();

        $metrics = [
            'revenue_this_week' => 3200,
            'revenue_last_week' => 2500,
            'orders_today' => 22,
            'failed_payments' => 8,
            'new_users' => 12,
        ];

        $prompt = "Summarize these metrics for dashboard insights: " . json_encode($metrics);

        // Added withoutVerifying() to bypass local SSL certificate issues
        $response = Http::withoutVerifying()
            ->withToken(env('OPENAI_API_KEY'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a dashboard insight generator.'],
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

        // Added basic error handling
        $insights = [];
        if ($response->successful()) {
            $aiText = $response->json('choices.0.message.content') ?? '';
            $insights = array_filter(array_map('trim', explode("\n", $aiText)));
        } else {
            Log::error('AI Dashboard Insight Failed: ' . $response->body());
            $insights = ['AI insights are currently unavailable.'];
        }

        return view('admin.dashboard', compact('insights'));
    }

    // ... (Keep your existing methods: orders, payments, users, etc.)

    protected function authorizeAdmin(): void
    {
        // Added check to prevent calling hasRole on a null user
        if (!Auth::check() || !Auth::user()->hasRole(['admin', 'Super Admin'])) {
            abort(403, 'Unauthorized access.');
        }
    }
}