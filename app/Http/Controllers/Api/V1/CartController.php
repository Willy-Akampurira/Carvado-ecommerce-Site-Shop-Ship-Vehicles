<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the authenticated user's cart items
     */
    public function index(): JsonResponse
    {
        $carItems = CarItem::with('car')->where('user_id', Auth::id())->get();
        return response()->json($carItems);
    }

    /**
     * Store a newly created cart item or update quantity if it already exists.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $carItem = CarItem::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'car_id' => $validated['car_id'],
            ],
            [
                'quantity' => $validated['quantity'] ?? 1,
            ]
        );

        return response()->json($carItem, 201);
    }

    /**
     * Display a specified cart item (only if it belongs to the user).
     */
    public function show(CartItem $carItem): JsonResponse
    {
            if ($cartItem->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($carItem);
    }

    /**
     * Update quantity of a specific cart item.
     */
    public function update(Request $request, CartItem $cartItem): JsonResponse
    {
        if ($cartItem->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->valiadte([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update(['quantity' => $validated['quantity']]);

        return response()->json($cartItem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem): JsonResponse
    {
        if ($cartItem->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $cartItem->delete();

        return response()->json(['message' => 'Item removed successfully']);
    }
}
