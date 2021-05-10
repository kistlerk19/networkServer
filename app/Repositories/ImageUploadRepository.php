<?php

namespace App\Repositories;

use App\Models\UserFile;
use App\Repositories\Contracts\ImageUploadRepositoryContract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadRepository implements ImageUploadRepositoryContract
{
  public function saveFile($file)
  {
    try {
      $newEntry = new UserFile();
      $newEntry->file_name = url(Storage::url($file));
      $newEntry->user_id = auth()->user()->id;
      $newEntry->save();

      return true;
    } catch (\Throwable $th) {
      throw $th;
    }
  }
}
