<?php

namespace App\Actions;

use App\Models\Equipment;
use App\Http\Resources\EquipmentResource;
use App\Http\Resources\ErrorResource;

class GetEquipmentAction
{
    public function execute($id)
    {
      $equipment = Equipment::find($id);
      if ($equipment) {
        return new EquipmentResource($equipment);
      } else {
        return new ErrorResource('Not found Equipment');
      }
    }
}
