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
      $newReset = new PasswordReset();
      $newReset->email = $email;
      $newReset->token = Str::random(48);
      $newReset->save();

      return $newReset;
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
