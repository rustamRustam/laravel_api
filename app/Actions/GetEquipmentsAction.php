<?php

namespace App\Actions;

use App\Models\Equipment;
use App\Http\Resources\EquipmentCollection;

use App\Services\QueryService;

class GetEquipmentsAction
{
    private $queryService;

    public function __construct(QueryService $queryService )
    {
        $this->queryService = $queryService;
    }

    public function execute(array $data_equipments)
    {
      return new EquipmentCollection( $this->queryService->GetWhereOrWhere(new Equipment(),['serial_number','desc'],$data_equipments)->paginate(5));
    }

}
