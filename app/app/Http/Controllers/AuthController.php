<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Response;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        
        $user = User::where('email', $request['email'])->firstOrFail();
        
        $token = $user->createToken('auth_token')->plainTextToken;

        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];

        $cookieData = json_encode($data);

        return response()
            ->json($data)
            ->withCookie(cookie()
            ->forever('user_token', $cookieData));
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
        'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
        ]);

        $user = User::where('email', $request['email'])->firstOrFail();
        
        $token = $user->createToken('auth_token')->plainTextToken;

        $data = [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];

        return response()
            ->json($data)
            ->withCookie(cookie()
            ->forever('user_token', $cookieData));
    }
}
