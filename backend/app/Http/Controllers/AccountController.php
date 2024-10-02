<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Hash;
use Illuminate\Http\Request;
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

        return response()->json(['message' => 'Account registered successfully!', 'account' => $account], 201);
    }

    public function login(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Check credentials
        $account = Account::where('username', $request->username)->first();

        if (!$account || !Hash::check($request->password, $account->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        return response()->json(['message' => 'Login successful!', 'account' => $account], 200);
    }

}
