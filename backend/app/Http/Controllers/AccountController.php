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

        return response()->json(['message' => 'Account registered successfully!', 'account' => $account], 201);
    }

    public function login(Request $request)
    {
        // Validate incoming request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // $result = Auth::guard('account')->attempt([
        //     'username' => $request->username,
        //     'password' => $request->password
        // ]);

        // if($result){
        //     return response()->json(['message' => 'Login successful'], 200);
        // }
        // $userId = Auth::guard('account')->id();
        // return response()->json(["message" => $userId]);
        // // Check credentials
        $account = Account::where('username', $request->username)->first();
        if ($account && Hash::check($request->password, $account->password)) {
            return response()->json(['message' => 'Login successful'], 200);
        }
    
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    

}
