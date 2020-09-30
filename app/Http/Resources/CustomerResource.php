<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use TCG\Voyager\Facades\Voyager;

class CustomerResource extends JsonResource
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
            "name"=> $this->name,
            "avatar"=> Voyager::image($this->avatar),
            "phone_number"=> $this->phone_number,
            "identity_number"=> $this->identity_number,
            "enterprise"=> $this->enterprise,
            "cumulative_points"=> $this->cumulative_points,
            "created_at"=> $this->created_at,
        ];
    }
}
