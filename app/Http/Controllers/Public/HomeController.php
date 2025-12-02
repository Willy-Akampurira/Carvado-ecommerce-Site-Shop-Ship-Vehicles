<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Car;

class HomeController extends Controller
{
    /**
     * Display the Carvado landing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch only cars marked as featured
        $featuredCars = Car::where('is_featured', true)->get();

        // Fetch distinct categories for filter buttons
        $categories = Car::select('category')->distinct()->pluck('category');

        // Pass both to the homepage view
        return view('public.home', compact('featuredCars', 'categories'));
    }
}
