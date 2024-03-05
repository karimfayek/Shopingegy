<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessTokenFactory;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
class LoginController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth-token')->plainTextToken;
    
            return response()->json(['token' => $token]);
        }
    
        return response()->json(['message' => 'Invalid credentials'], 422);
    }


    public function logout()
    {
        Auth::user()->tokens()->delete();
        Auth::guard('web')->logout();

        return response()->json(['loged out' => 'out']);
    }
    
}