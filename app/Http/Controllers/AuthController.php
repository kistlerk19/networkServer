<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterUserRequest $request)
    {
        $user = $this->userService->registerUser($request->all());

        return response()->json([
            'data' =>[
                'success' => true,
                'user' => $user
            ]
        ]);
    }

    public function login(LoginUserRequest $request)
    {
        $user = $this->userService->loginUser($request->all());

        if ($user)
        {
           $token = $user->createToken('InsideMyCorruptedMind');

            return response()->json([
                'accessToken' => $token->accessToken,
                'token-type' => 'Bearer',
                'expires_at' => $token->token->expires_at,
                'user' => $user
            ]); 
        }

        return response()->json([
            'error' => 'Unauthorised'
        ], 401); 
        
    }
}
