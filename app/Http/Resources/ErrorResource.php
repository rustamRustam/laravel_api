<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
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

        $errors = 'Unknown error';
        if(is_string($this->resource) && isset($request->id) ) {
            $errors = [
                [
                    "message" => $this->resource,
                    "id"=> (int)$request->id,
                ],
            ];
        } else {
            $errors = parent::toArray($request);
        }

        return [
            "errors" => $errors
        ];
    }
}
