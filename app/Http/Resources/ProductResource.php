<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use TCG\Voyager\Facades\Voyager;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $images = array();
        foreach (json_decode($this->images) as $image){
            $images[] = Voyager::image($image);
        }
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "slug"=> $this->slug,
            "details"=> $this->details,
            "price"=> $this->price,
            "description"=> $this->description,
            "thumbnail" => Voyager::image($this->thumbnail('medium')),
            "image"=> Voyager::image($this->image),
            "images"=> $images,
            "category_id"=> $this->category_id,
            "status"=> $this->status,
            "featured"=> $this->featured,
        ];
    }
}
