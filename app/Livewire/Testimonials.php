<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Testimonial;

class Testimonials extends Component
{
    use WithFileUploads;

    public $name;
    public $text;
    public $photo;
    public $rating;

    public function mount()
    {
        $this->rating = 5; // Default value on initial render
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required|min:2|max:255',
            'text' => 'required|min:10|max:1000',
            'photo' => 'nullable|image|max:1024',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $photoPath = $this->photo
            ? $this->photo->store('photos', 'public')
            : 'default-avatar.png';

        Testimonial::create([
            'name' => $this->name,
            'text' => $this->text,
            'photo' => $photoPath,
            'rating' => $this->rating,
        ]);

        $this->reset(['name', 'text', 'photo', 'rating']);
        $this->rating = 5; // Re-initialize after reset

        session()->flash('success', 'Thank you for sharing your feedback!');
    }

    public function render()
    {
        return view('livewire.testimonials', [
            'testimonials' => Testimonial::latest()->take(6)->get(),
        ]);
    }
}
