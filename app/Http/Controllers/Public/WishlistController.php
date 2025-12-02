<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    /**
     * Display the authenticated user's wishlist.
     */
    public function index()
    {
        $wishlist = Wishlist::with('car')
            ->where('user_id', Auth::id())
            ->latest('added_at')
            ->get();

        return view('wishlist.index', compact('wishlist'));
    }

    /**
     * Add a car to the user's wishlist.
     */
    public function add($carId)
    {
        $userId = Auth::id();

        $exists = Wishlist::where('user_id', $userId)
            ->where('car_id', $carId)
            ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => $userId,
                'car_id' => $carId,
                'added_at' => now(),
            ]);
        }

        return back()->with('success', 'Car added to your wishlist!');
    }

    /**
     * Remove a car from the user's wishlist.
     */
    public function remove($carId)
    {
        Wishlist::where('user_id', Auth::id())
            ->where('car_id', $carId)
            ->delete();

        return back()->with('success', 'Car removed from your wishlist.');
    }
}
