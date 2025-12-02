<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the contact form view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('public.contact');
    }

    /**
     * Handle the submitted contact form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Request $request)
    {
        // Validate the form input
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:100',
            'message' => 'required|string|max:2000',
        ]);

        // For now, just flash a success message
        // You can later add mailing or storage logic here
        return redirect()->back()->with('success', 'Thanks for reaching out! We’ll get back to you soon.');
    }
}
