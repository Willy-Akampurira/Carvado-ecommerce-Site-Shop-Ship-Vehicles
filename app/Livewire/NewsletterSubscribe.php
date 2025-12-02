<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class NewsletterSubscribe extends Component
{
    public string $email = '';

    public function subscribe()
    {
        $this->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        DB::table('subscribers')->insert([
            'email' => $this->email,
            'created_at' => now(),
        ]);

        $this->reset('email');

        session()->flash('success', 'Thanks for subscribing!');
    }

    public function render()
    {
        return view('livewire.newsletter-subscribe');
    }
}
