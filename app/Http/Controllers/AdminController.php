<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

        $response = Http::withToken(env('OPENAI_API_KEY'))->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a dashboard insight generator.'],
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $aiText = $response['choices'][0]['message']['content'] ?? '';
        $insights = array_filter(array_map('trim', explode("\n", $aiText)));

        return view('admin.dashboard', compact('insights'));
    }

    /**
     * Display the orders management page.
     */
    public function orders(): \Illuminate\View\View
    {
        $this->authorizeAdmin();
        return view('admin.orders');
    }

    /**
     * Display the payments overview page.
     */
    public function payments(): \Illuminate\View\View
    {
        $this->authorizeAdmin();
        return view('admin.payments');
    }

    /**
     * Display the user management page.
     */
    public function users(): \Illuminate\View\View
    {
        $this->authorizeAdmin();
        return view('admin.users');
    }

    /**
     * Display the vehicle inventory page.
     */
    public function inventory(): \Illuminate\View\View
    {
        $this->authorizeAdmin();
        return view('admin.inventory');
    }

    /**
     * Display the analytics and reports page.
     */
    public function analytics(): \Illuminate\View\View
    {
        $this->authorizeAdmin();
        return view('admin.analytics');
    }

    /**
     * Display the notifications and logs page.
     */
    public function notifications(): \Illuminate\View\View
    {
        $this->authorizeAdmin();
        return view('admin.notifications');
    }

    /**
     * Display the system logs page.
     */
    public function logs(): \Illuminate\View\View
    {
        $this->authorizeAdmin();
        return view('admin.logs');
    }

    /**
     * Centralized role check for admin access.
     */
    protected function authorizeAdmin(): void
    {
        if (!Auth::user()->hasRole(['admin', 'Super Admin'])) {
            abort(403, 'Unauthorized access.');
        }
    }
}
