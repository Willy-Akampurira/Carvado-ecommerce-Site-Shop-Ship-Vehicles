<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Public\Car;

class SearchController extends Controller
{
    /**
     * Handle search queries and show matching vehicles.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        // 🔍 Fetch cars where make or model matches query
        $cars = Car::where('make', 'like', '%' . $query . '%')
                   ->orWhere('model', 'like', '%' . $query . '%')
                   ->get();

        // ✅ Pass both cars and query to view
        return view('Public.search', compact('query', 'cars'));
    }
}
