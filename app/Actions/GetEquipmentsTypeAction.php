<?php

namespace App\Actions;

use App\Models\EquipmentType;
use App\Http\Resources\EquipmentTypeCollection;

use App\Services\QueryService;

class GetEquipmentsTypeAction
{
    private $queryService;

    public function __construct(QueryService $queryService )
    {
        $this->queryService = $queryService;
    }

    public function execute(array $data_equipments_type)
    {
      return new EquipmentTypeCollection( $this->queryService->GetWhereOrWhere(new EquipmentType(),['name','mask'],$data_equipments_type)->paginate(5));
    }

}
