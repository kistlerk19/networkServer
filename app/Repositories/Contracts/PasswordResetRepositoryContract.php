<?php

namespace App\Repositories\Contracts;

interface PasswordResetRepositoryContract 
{
  public function createPasswordReset($email);
}