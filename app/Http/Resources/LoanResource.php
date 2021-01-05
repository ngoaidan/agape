<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class LoanResource extends JsonResource
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
            "id"=> $this->id,
            "customer"=> Auth::user()->name,
            "loan"=> $this->loan,
            "term"=> $this->term,
            "salary"=> $this->salary,
            "matp"=> $this->province,
            "status"=>$this->status,
            "created_at"=> Carbon::parse($this->created_at)->format('d-m-Y'),
        ];
    }
}
