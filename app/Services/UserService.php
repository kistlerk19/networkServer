<?php

namespace App\Services;

use App\Helpers\MiscHelpers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\UserRepositoryContract;

class UserService
{

  protected $userRepositoryContract;
  protected $miscHelpers;

  public function __construct(UserRepositoryContract $userRepositoryContract, MiscHelpers $miscHelpers)
  {
    $this->userRepositoryContract = $userRepositoryContract;
    $this->miscHelpers = $miscHelpers;
  }

  public function registerUser(array $data)
  {
    $identifier = $this->miscHelpers->IDGenerator(new User, 'identifier', 8, 'AUTHC');

    $userData = [
      'name' => $data['name'],
      'username' => $data['username'],
      'email' => $data['email'],
      'password' => bcrypt($data['password']),
      'identifier' => $identifier
    ];

    $newUser = $this->userRepositoryContract->registerUser($userData);

    // $token = $newUser->createToken('InsideMyCorruptedMind')->accessToken;

    // return [
    //   'user' => $newUser,
    //   'token' => $token,
    // ];

    return $newUser;
  }

  public function loginUser(array $data)
  {
    if (Auth::attempt([
      'email' => $data['email'],
      'password' => $data['password']
    ])) {
      $user = Auth::user();

      return $user;
    }

    return false;
  }

  public function checkUserIsActivated($email)
  {
    $checkIfUserExists = $this->userRepositoryContract->checkIfUserExistsByEmail($email);

    if ($checkIfUserExists && $checkIfUserExists->email_verified_at) {
      return true;
    } 

    return false;
  }
  
  public function checkEmail($email)
  {
    $checkIfUserExists = $this->userRepositoryContract->checkIfUserExistsByEmail($email);

    if ($checkIfUserExists) {
      return true;
    } 

    return false;
  }
  
  
  public function getUserByEmail($email)
  {
    $checkIfUserExists = $this->userRepositoryContract->getUserByEmail($email);

    if ($checkIfUserExists) {
      return $checkIfUserExists;
    } 

    return null;
  }
}
