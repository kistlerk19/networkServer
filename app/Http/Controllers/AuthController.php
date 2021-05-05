<?php

namespace App\Http\Controllers;

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

        // $token = $user->createToken('InsideMyCorruptedMind')->accessToken;

        // $response = [
        //     'user' => $user,
        //     'token' => $token,
        // ];
        
        return response()->json([
            'data' =>[
                'success' => true,
                'user' => $user
            ]
        ]);
    }
}
