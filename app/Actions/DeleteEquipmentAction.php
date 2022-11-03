<?php

namespace App\Actions;

use App\Models\Equipment;

use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;

class DeleteEquipmentAction
{
    public function execute($id)
    {
      $equipment = Equipment::destroy($id);
      if ($equipment) {
        return new SuccessResource('Deletion successful');
      } else {
        return new ErrorResource('Not found Equipment');
      }
    }
}
