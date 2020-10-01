<?php

namespace App\Http\Resources;

use App\Models\Service;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderServiceResource extends JsonResource
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
            "status"=> $this->status,
            "service"=> new ServiceResource($this->service),
            "billing_total"=> $this->billing_total,
            "cumulative_points"=> $this->cumulative_points,
            "created_at"=> $this->created_at
        ];
    }
}
