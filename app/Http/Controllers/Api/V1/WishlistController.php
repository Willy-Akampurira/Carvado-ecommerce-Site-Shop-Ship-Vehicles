<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the authenticated user's wishlist items.
     */
    public function index(): JsonResponse
    {
        $wishlist = wishlist::with('car')
        ->where('user_id' , Auth::id())
        ->latest('added_at')
        ->get();

        return response()->json($wishlist);
    }

    /**
     * Add a car to the authenticated user's wishlist.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars, id',
        ]);

        $wishlist = wishlist::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'car_id' => $validated['car_id'],
            ],
            [
                'added_at' => now(),
            ]
        );

        return response()->json($wishlist, 201);
    }

    /**
     * Show details of a specific wishlist entry (if owned).
     */
    public function show(Wishlist $wishlist): JsonResponse
    {
        if ($wishlist->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($wishlist->load('car'));
    }

    /**
     * Update wishlist entry notes or timestamp (optional use).
     */
    public function update(Request $request, Wishlist $wishlist): JsonResponse
    {
        if ($wishlist->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'added_at' => 'nullable',
        ]);

        $wishlist->update($validated);

        return response()->json($wishlist);
    }

    /**
     * Remove a wishlist entry.
     */
    public function destroy(Wishlist $wishlist): JsonResponse
    {
        if ($wishlist->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $wishlist->delete();

        return response()->json(['message' => 'car removed from wishlist']);
    }
}
