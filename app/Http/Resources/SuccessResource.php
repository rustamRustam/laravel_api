<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SuccessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        parent::withoutWrapping();

        $success = 'Success';
        if(is_string($this->resource) && isset($request->id) ) {
            $success = [
                [
                    "message" => $this->resource,
                    "id"=> (int)$request->id,
                ],
            ];
        } else {
            $success = parent::toArray($request);
        }

        return [
            "success" => $success
        ];

    }
}
