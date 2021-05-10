<?php

namespace App\Services;

use App\Repositories\Contracts\ImageUploadRepositoryContract;
use Illuminate\Support\Facades\Auth;

class ImageUploadService
{
  protected $passwordResetRepositoryContract;

  public function __construct(ImageUploadRepositoryContract $imageUploadRepositoryContract)
  {
    $this->passwordResetRepositoryContract = $imageUploadRepositoryContract;
  } 

  public function saveFile($file)
  {
    return $this->passwordResetRepositoryContract->saveFile($file);
  }

}
