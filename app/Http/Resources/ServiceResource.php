<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use TCG\Voyager\Facades\Voyager;

class ServiceResource extends JsonResource
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
            "category_id"=> $this->category_id,
            "title"=> $this->title,
            "price"=> number_format($this->price, 0,",","."),
            "body"=> $this->body,
            "thumbnail" => Voyager::image($this->thumbnail('medium')),
            "image"=> Voyager::image($this->image),
            "status"=> $this->status,
            "featured"=> $this->featured,
        ];
    }
}
