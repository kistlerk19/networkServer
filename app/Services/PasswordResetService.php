<?php

namespace App\Services;

use App\Repositories\Contracts\PasswordResetRepositoryContract;
use Illuminate\Support\Facades\Auth;

class PasswordResetService
{
  protected $passwordResetRepositoryContract;

  public function __construct(PasswordResetRepositoryContract $passwordResetRepositoryContract)
  {
    $this->passwordResetRepositoryContract = $passwordResetRepositoryContract;
  } 

  public function createPasswordReset($email)
  {
    return $this->passwordResetRepositoryContract->createPasswordReset($email);
  }
}
