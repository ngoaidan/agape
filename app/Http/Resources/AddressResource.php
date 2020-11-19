<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'type'=>$this->type,
            'matp' => $this->matp,
            'industrial_areas'=>IndustrialResource::collection($this->industrial_areas),
        ];
    }
}
