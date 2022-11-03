<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GetEquipmentsRequest;
use App\Http\Requests\GetEquipmentsTypeRequest;
use App\Http\Requests\ChangeEquipmentRequest;
use App\Actions\GetEquipmentsAction;
use App\Actions\GetEquipmentsTypeAction;
use App\Actions\ChangeEquipmentAction;
use App\Actions\DeleteEquipmentAction;
use App\Actions\GetEquipmentAction;
use App\Actions\AddEquipmentAction;


class EquipmentController extends Controller
{
    public function get_equipments(
      GetEquipmentsRequest $request,
      GetEquipmentsAction $equipmentsAction
    ) {
      return $equipmentsAction->execute($request->validated());
    }

    public function get_equipment_by_id($id,
      GetEquipmentAction $getEquipmentAction
    ) {
      return $getEquipmentAction->execute($id);
    }

    public function change_equipment_by_id($id,
      ChangeEquipmentRequest $request,
      ChangeEquipmentAction $changeEquipmentAction)
    {
      return $changeEquipmentAction->execute($id, $request->validated());
    }


    public function delete_equipment_by_id($id,
      DeleteEquipmentAction $deleteEquipmentAction
    ) {
      return $deleteEquipmentAction->execute($id);
    }

    public function get_equipments_type(
      GetEquipmentsTypeRequest $request,
      GetEquipmentsTypeAction $equipmentsTypeAction
    ) {
      return $equipmentsTypeAction->execute($request->validated());
    }

    public function add_equipment(
      Request $request,
      AddEquipmentAction $addEquipmentAction
    ) {
      return response()->json($addEquipmentAction->execute($request->all()));
    }

}
