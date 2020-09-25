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
            "seo_title"=> $this->seo_title,
            "excerpt"=> $this->excerpt,
            "body"=> $this->body,
            "thumbnail" => Voyager::image($this->thumbnail('medium')),
            "image"=> Voyager::image($this->image),
            "slug"=> $this->slug,
            "meta_description"=> $this->meta_description,
            "meta_keywords"=> $this->meta_keywords,
            "status"=> $this->status,
            "featured"=> $this->featured,
        ];
    }
}
