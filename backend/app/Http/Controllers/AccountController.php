<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AccountController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|unique:accounts|max:255',
            'email' => 'required|string|email|unique:accounts|max:255',
            'password' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create the account
        $account = Account::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);


        // Create token after registration
        $token = $account->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Account registered successfully!',
            'account' => $account,
            'token' => $token
        ], 201);

        // return response()->json(['message' => 'Account registered successfully!', 'account' => $account], 201);
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $credentials = $request->only('username', 'password');

            if (Auth::guard('account')->attempt($credentials)) {
                $account = Auth::guard('account')->user();
                $token = $account->createToken('auth-token')->plainTextToken;
                // \Log::info('Token generated:', ['token' => $token]); // Debug logging
                return response()->json([
                    'message' => 'Login successful',
                    'token' => $token,
                    
                ], 200);
            }

            return response()->json(['error' => 'Invalid credentials'], 401);
        } catch (\Exception $e) {
            \Log::error('Login error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Login failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    // Add logout method
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }

}
