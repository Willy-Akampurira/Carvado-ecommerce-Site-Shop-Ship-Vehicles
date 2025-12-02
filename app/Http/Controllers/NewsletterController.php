<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class NewsletterController extends Controller
{
    /**
     * Show the newsletter subscription form via Livewire.
     */
    public function showForm()
    {
        return view('newsletter'); // This view wraps the Livewire component
    }

    /**
     * Handle the newsletter subscription (optional if using Livewire).
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        Subscriber::create([
            'email' => $request->email,
        ]);

        return redirect()->route('newsletter.form')->with('success', 'Thanks for subscribing!');
    }
}
