<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            "status"=> $this->statusName(),
            "product"=> new ProductResource($this->product),
            "billing_total"=> $this->billing_total,
            "cumulative_points"=> $this->cumulative_points,
            "created_at"=> $this->created_at
        ];
    }
}
