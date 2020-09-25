<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Product extends Model
{
    use Translatable, Resizable;
    protected $guarded = [];

    const PUBLISHED = 'PUBLISHED';

    public function scopePublished(Builder $query)
    {
        return $query->where('status', '=', static::PUBLISHED);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
