<?php

namespace App\Actions;

use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Http\Resources\ErrorResource;
use App\Http\Resources\SuccessResource;
use App\Services\CheckSerialNumberService;

class ChangeEquipmentAction
{
    public function execute($id, array $data_change_equipment) {
      $equipment = Equipment::whereId($id)->first();
      if ($equipment) {

        $equipmentType = EquipmentType::find($data_change_equipment['id_type']);
        if ($equipmentType) {
          if(CheckSerialNumberService::execute($equipmentType->mask, $data_change_equipment['serial_number']) ){
            try{
              $equipment->update($data_change_equipment);
            } catch (\Illuminate\Database\QueryException $e) {
              return new ErrorResource(array_merge(['message' => 'Please check params.','id' => $id],$data_change_equipment));
            }
            return new SuccessResource($equipment);
          } else {
            return new ErrorResource(array_merge(['message' => "Please check params.(Not correct serial_number)",'id' => $id],$data_change_equipment));
          }
        } else {
          return new ErrorResource(array_merge(['message' => "Please check params.(Not find equipment_type_id)",'id' => $id],$data_change_equipment));
        }

      } else {
          return new ErrorResource(array_merge(['message' => 'Not found Equipment','id' => $id],$data_change_equipment));
      }

    }

}
