<?php

namespace App\Repositories;

use App\Models\PasswordReset;
use App\Models\StatusUpdate;
use Illuminate\Support\Str;
use App\Repositories\Contracts\PasswordResetRepositoryContract;

class PasswordResetRepository implements PasswordResetRepositoryContract
{
  public function createPasswordReset($email)
  {
    try {

      $newReset = PasswordReset::updateOrCreate(
        ['email' => $email],
        [
          'email' => $email,
          'token' => Str::random(64),
        ]
      );
      
      return $newReset;
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function checkReset($email, $token)
  {
    return PasswordReset::where([
      'email' => $email,
      'token' => $token
    ])->first();
  }
}
