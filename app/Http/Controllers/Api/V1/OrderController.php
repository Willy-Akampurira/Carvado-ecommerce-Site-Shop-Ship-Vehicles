<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * List all orders for the authenticated user.
     */
    public function index(): JsonResponse
    {
        $orders = Order::where('user_id', Auth::id())->with('items')->latest()->get();
        return response()->json($orders);
    }

    /**
     * Create a new order entry.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'total_price' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:500',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'order_number' => strtoupper(Str::random(10)),
            'status' => 'pending',
            'total_price' => $validated['total_price'],
            'notes' => $validated['notes'] ?? null,
        ]);

        return response()->json($order, 201);
    }

    /**
     * Show a specific order (if owned by authenticated user).
     */
    public function show(string $id)
    {
        if ($order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($order->load('items'));
    }

    /**
     * Update an existing order's status or notes.
     */
    public function update(Request $request, Order $order): JsonResponse
    {
        if ($order->user_id !==Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->valiadate([
            'status' => 'required|in:pending,confirmed,shipped,delivered,cancelled',
            'notes'  => 'nullable|string|max:500',
        ]);

        $order->update($validated);

        return response()->json($order);
    }

    /**
     * Delete a specific order.
     */
    public function destroy(Order $order): JsonResponse
    {
        if ($order->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $order->delete();

        return response()->json(['message' => 'order deleted successfully']);
    }
}
