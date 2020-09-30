<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
            "cumulative_points"=> $this->cumulative_points,
            "sex" => $this->sex,
            "tp_live" => $this->province->name,
            "birth" => Carbon::parse($this->birth)->format('d-m-Y'),
            "enterprise"=> $this->enterprise,
            "created_at"=> Carbon::parse($this->created_at)->format('d-m-Y'),
        ];
    }
}
