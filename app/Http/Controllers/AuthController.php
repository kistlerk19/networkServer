<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterUserRequest $request) {

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('InsideMyCorruptedMind')->accessToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];
        
        return response()->json([
            'data' =>[
                'success' => true,
                'user' => $user,
                'token' => $token,
            ]
        ]);
    }
}
