<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Mail\RegisterUserMail;
use App\Models\User;
use App\Services\PasswordResetService;
use App\Services\UserActivationTokenService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    protected $userService;
    protected $responseHelper;
    protected $userActivationTokenService;
    protected $passwordResetService;

    public function __construct(
        UserService $userService, 
        ResponseHelper $responseHelper, 
        UserActivationTokenService $userActivationTokenService,
        PasswordResetService $passwordResetService)
    {
        $this->userService = $userService;
        $this->responseHelper = $responseHelper;
        $this->userActivationTokenService = $userActivationTokenService;
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * @param $request
     */
    public function register(RegisterUserRequest $request)
    {
        $user = $this->userService->registerUser($request->all());

        if ($user) {
            $token = $this->userActivationTokenService->createNewToken($user->id);

            Mail::to($user->email)->send(new RegisterUserMail($user, $token->token));

            return $this->responseHelper->successResponse(true, 'Check your email for confirmation.', $user);
        }

        return $this->responseHelper->errorResponse(false, 'Oopsie! Something went wrong!', null, 500);

        // return response()->json([
        //     'data' =>[
        //         'success' => true,
        //         'user' => $user
        //     ]
        // ]);
    }

    public function login(LoginUserRequest $request)
    {
        $activated = $this->userService->checkUserIsActivated($request->email);

        if (!$activated) {
            return $this->responseHelper->errorResponse(false, 'User account must be activated!', null, 401);
        }

        $user = $this->userService->loginUser($request->all());

        if ($user) {
            $token = $user->createToken('InsideMyCorruptedMind');

            $data = [
                'user' => $user,
                'expires_at' => $token->token->expires_at,
                'token-type' => 'Bearer',
                'accessToken' => $token->accessToken,
            ];

            return $this->responseHelper->loginSuccess(true, "Activate User!", $data);
        }

        return $this->responseHelper->errorResponse(false, 'User not found', null, 401);
    }

    public function activateEmail($code)
    {
        $checkToken = $this->userActivationTokenService->checkToken($code);

        return $this->responseHelper->successResponse(true, "User Activation!", $checkToken);
    }

    public function forgotPassword(Request $request)
    {
        $checkUserEmail = $this->userService->checkEmail($request->email);

        if (!$checkUserEmail) {
            return $this->responseHelper->errorResponse(false, "User email does not exist", null, 404);
        }

        $createPasswordReset = $this->passwordResetService->createPasswordReset($request->email);

        return $this->responseHelper->successResponse(true, "Check Your Email", $createPasswordReset);
    }

    public function me()
    {
        $user = Auth::user();

        return $this->responseHelper->successResponse(true, "Authenticated user!", $user);
    }
}
