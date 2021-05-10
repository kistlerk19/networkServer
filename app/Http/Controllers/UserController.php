<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $responseHelper;
 
    public function __construct(ResponseHelper $responseHelper)
    {
        $this->responseHelper = $responseHelper;
    }

    public function me()
    {
        $user_id = Auth::user()->id;

        $user = User::with(['status_updates'])->find($user_id);

        // $statusUpdates = $user->status_updates()->get();

        return $this->responseHelper->successResponse(true, 'Authenticated user!', $user);
    }
}
