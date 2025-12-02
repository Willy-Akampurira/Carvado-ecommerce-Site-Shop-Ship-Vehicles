<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Retrieve the authenticated user's profile.
     */
    public function index(): JsonResponse
    {
        return response()->json(Auth::user());
    }

    /**
     * Reserved fro admin: create a user account manually.
     */
    public function store(Request $request): JsonResponse
    {
        if (!Auth::user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $valiadted = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = \App\Models\User::create([
            'name' => $valiadted['name'],
            'email' => $valiadted['email'],
            'password' => Hash::make($valiadted['password']),
        ]);

        return response()->json(['message' => 'User created', 'user' => $user], 201);
    }

    /**
     * Display a specific user profile (for admin viewing others).
     */
    public function show($id): JsonResponse
    {
        if (Auth::id() != $id && !Auth::user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $user = \App\Models\User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the authenticated user's profile.
     */
    public function update(Request $request): JsonResponse
    {
        $valiadted = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (isset($valiadted['name'])) {
            $user->name = $valiadted['name'];
        }

        if (isset($valiadted['email'])) {
            $user->email = $valiadted['email'];
        }

        if (isset($valiadted['password'])) {
            $user->password = Hash::make($valiadted['password']);
        }

        $user->save();
    }

    /**
     * Remove the authenticated user's account.
     */
    public function destroy(): JsonResponse
    {
        $user = Auth::user();
        $user->delete();

        return response()->json(['message' => 'User account deleted']);
    }
}
