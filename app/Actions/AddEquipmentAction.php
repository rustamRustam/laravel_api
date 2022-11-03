<?php

namespace App\Actions;

use Illuminate\Support\Facades\Validator;

use App\Models\Equipment;
use App\Models\EquipmentType;
use App\Http\Resources\EquipmentTypeResource;
use App\Services\CheckSerialNumberService;

class AddEquipmentAction
{

    public function execute(array $data_equipments)
    {
      $errors = [];
      $success = [];
      if(count($data_equipments)) {

        $type_ids = [];
        foreach($data_equipments as $ind => $equipment ) {
          $validator = Validator::make($equipment, [
            'equipment_type_id' => 'required|numeric|gt:0',
            'serial_number' => 'required|string|max:250',
            "desc" => 'string|max:250'
          ]);
          if ($validator->fails()) {
            $errors[$ind] = array_merge(
              ["message" => "Please check params.","message_by_params" => $validator->errors()],
              $equipment
            );
            $data_equipments[$ind] = false;
          } else {
            $type_ids[] = $equipment['equipment_type_id'];
          }

        }
        if(count($type_ids)) {
          $equipment_types = EquipmentType::whereIn('id',$type_ids)->get();
          foreach($data_equipments as $ind => $equipment ) {
            if($equipment){
              $find_eq = $equipment_types->find($equipment['equipment_type_id']);
              if ($find_eq) {
                if(CheckSerialNumberService::execute($find_eq->mask,$equipment['serial_number'])){
                  try {
                    $newEquipment = Equipment::create([
                      'id_type'=>$equipment['equipment_type_id'],
                      'serial_number'=>$equipment['serial_number'],
                      'desc'=>$equipment['desc'],
                    ]);

                    $newEquipment->save();

                    $success[$ind] = array_merge(
                      $newEquipment->toArray(),
                      ["equipment_type"=>new EquipmentTypeResource($find_eq) ]
                    );

                  } catch (\Illuminate\Database\QueryException $e) {
                    $errors[$ind] = array_merge(
                      ["message" => "Please check params.(Not save BD)"],
                      $equipment
                    );
                  }

                } else {
                  $errors[$ind] = array_merge(
                    ["message" => "Please check params.(Not correct serial_number)"],
                    $equipment
                  );
                }
              } else {
                $errors[$ind] = array_merge(
                  ["message" => "Please check params.(Not find equipment_type_id)"],
                  $equipment
                );
              }
            }
          }
        }


      } else {
        $errors[] = array_merge(
          ["message" => "Please check params.(Its empty)"],
          $data_equipments
        );
      }

      return [
        "errors" => (object)$errors,
        "success" => (object)$success,
      ];
    }

}
