<?php

namespace App\Services;

use App\Repositories\Contracts\UserActivationTokenRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserActivationTokenService
{

  protected $activationTokenRepositoryContract;
  protected $userRepositoryContract;

  public function __construct(UserActivationTokenRepositoryContract $activationTokenRepositoryContract, UserRepositoryContract $userRepositoryContract)
  {
    $this->activationTokenRepositoryContract = $activationTokenRepositoryContract;
    $this->userRepositoryContract = $userRepositoryContract;
  }

  public function createNewToken(int $userId)
  {
    $token = Str::random(48);

    return $this->activationTokenRepositoryContract->createToken($userId, $token);
  }
  
  public function checkToken($code)
  {
    $token = $this->activationTokenRepositoryContract->checkToken($code);

    if ($token)
    {
      $userId = $token->user_id;

      $this->userRepositoryContract->activateUser($userId);

      $token->delete();

      return "User has been activated!";
    }

    return "User has not been activated!";
  }

}
