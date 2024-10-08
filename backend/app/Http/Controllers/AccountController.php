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

        
    }

    public function login(Request $request)
    {
        try {
            // $validatedData = Validator::make($request->all(), [
            //     'username' => 'required|string',
            //     'password' => 'required|string',
            // ]);

            $validatedData = $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            // if ($validatedData->fails()) {
            //     return response()->json($validatedData->errors(), 422);
            // }

            // $credentials = $request->only('username', 'password');

            // if (Auth::guard('account')->attempt($credentials)) {
            //     $account = Auth::guard('account')->user();
            //     $token = $account->createToken('auth-token')->plainTextToken;
               
            //     return response()->json([
            //         'message' => 'Login successful',
            //         'token' => $token,
                    
            //     ], 200);
            // }

            $user = Account::where('username', $validatedData['username'])->first();

            if($user && Hash::check($validatedData['password'], $user->password))

            {

                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([

                    'access_token' => $token,

                    'token_type' => 'Bearer',

                    'user' =>$user

                ], 200);

            }
 

            return response()->json(['error' => 'Invalid credentials'], status: 401);
        } catch (\Exception $e) {
            
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
