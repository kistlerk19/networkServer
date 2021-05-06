<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;
    protected $responseHelper;
    
    public function __construct(UserService $userService, ResponseHelper $responseHelper)
    {
        $this->userService = $userService;
        $this->responseHelper = $responseHelper;
    }

    /**
     * @param $request
     */
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

           $data = [
            'user' => $user,
            'expires_at' => $token->token->expires_at,
            'token-type' => 'Bearer',
            'accessToken' => $token->accessToken,
           ];

            return $this->responseHelper->loginSuccess(true, "Authenticated user!", $data); 
        }

        return $this->responseHelper->errorResponse(false, 'User not found', null, 401); 
    }

    public function me() 
    {
        $user = Auth::user();

        return $this->responseHelper->successResponse(true, "Authenticated user!", $user); 
    }
}
