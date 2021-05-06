<?php

namespace App\Repositories;

use App\Models\StatusUpdate;
use App\Models\User;
use App\Repositories\Contracts\StatusUpdateRepositoryContract;

class StatusUpdateRepository implements StatusUpdateRepositoryContract
{
  public function newStatus(array $data) 
  {
    try {
      $newStatus = new StatusUpdate();
      $newStatus->fill($data);
      $newStatus->save();

      return $newStatus;
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

}
