<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use TCG\Voyager\Facades\Voyager;

class CategoryNonChildrenResource extends JsonResource
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
            "parent_id"=> $this->parent_id,
            "order"=> $this->order,
            "name"=> $this->name,
            "thumbnail"=> Voyager::image($this->thumbnail),
            "description"=> $this->description,
            "image"=> Voyager::image($this->image),
        ];
    }
}
