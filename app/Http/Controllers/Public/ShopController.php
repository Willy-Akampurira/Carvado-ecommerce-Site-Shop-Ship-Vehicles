<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a list of cars available for shopping and shipping.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all cars marked as 'available'
        $cars = Car::where('status', 'available')->get();

        // Fetch distinct categories for filtering UI
        $categories = Car::select('category')->distinct()->pluck('category');

        return view('public.shop', compact('cars', 'categories'));
    }

    /**
     * Filter cars by selected category.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function filterByCategory(Request $request)
    {
        $category = $request->input('category');

        // Filter cars by category and availability
        $cars = Car::where('status', 'available')
                    ->where('category', $category)
                    ->get();

        // Fetch all categories for UI consistency
        $categories = Car::select('category')->distinct()->pluck('category');

        return view('public.shop', compact('cars', 'categories', 'category'));
    }

    /**
     * Display a single car's details.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $car = Car::findOrFail($id);

        // ✅ Wrap single car in a collection to match Blade loop
        $cars = collect([$car]);

        // Optional: empty categories for consistency
        $categories = [];

        return view('public.shop', compact('cars', 'categories'));
    }
}
