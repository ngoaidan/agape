<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndustrialResource extends JsonResource
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
            'id'=>$this->id,
            'code'=>$this->code,
            'matp' => $this->matp,
            'makcn'=>$this->makcn,
            'name' => $this->name,
            'enterprises'=>EnterpriseResource::collection($this->enterprises),
        ];
    }
}
