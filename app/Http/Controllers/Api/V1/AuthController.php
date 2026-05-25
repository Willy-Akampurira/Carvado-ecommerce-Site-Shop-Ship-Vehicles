<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Hybrid Sync Logic (Plan B)
     * Handles the handshake after Flutter registers a user via Firebase.
     */
    public function syncFirebaseUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'firebase_uid' => 'required|string',
        ]);

        // Find existing user or create a new one
        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => $validated['name'],
                'firebase_uid' => $validated['firebase_uid'],
                // Set a random password as Firebase handles the real auth
                'password' => Hash::make(Str::random(16)), 
            ]
        );

        // Ensure the 'client' role is assigned (Spatie)
        if (!$user->hasRole('client')) {
            $user->assignRole('client');
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Firebase user synced with Laravel database',
            'token' => $user->createToken('api-token')->plainTextToken,
            'user' => $user->load('roles'),
        ], 201);
    }

    /**
     * Standard Registration (Plan A)
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('client');

        return response()->json([
            'status' => 'success',
            'message' => 'User registered successfully as a Client',
            'token' => $user->createToken('api-token')->plainTextToken,
            'user' => $user->load('roles'), 
        ], 201);
    }

    /**
     * User login logic
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'The provided credentials do not match our records.',
                'errors' => [
                    'email' => ['Invalid email or password'],
                ]
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'token' => $user->createToken('api-token')->plainTextToken,
            'user' => $user->load('roles'),
        ]);
    }

    /**
     * User logout logic
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully'
        ]);
    }
}