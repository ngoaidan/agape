<?php

namespace App\Http\Resources;

use App\Models\Category;
use Carbon\Carbon;
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
        $categories = Category::all();
        $category = Category::rootCategory($this->product->category_id, $categories);
//        $category = $this->rootCategory(17, $categories);
//        dd($category);
        return [
//            "status"=> $this->statusName(),
            "category" => $category->name,
            "product" => $this->product->name,
            "icon" => $category->icon,
//            "billing_total"=> $this->billing_total,
//            "cumulative_points"=> $this->cumulative_points,
            "created_date"=> Carbon::parse($this->created_at)->format('d \t\h\g m Y'),
            "created_time"=> Carbon::parse($this->created_at)->format('g:i A'),
//            "product"=> new ProductResource($this->product),
        ];
    }


}
