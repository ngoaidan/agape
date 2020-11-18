<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    protected $guarded = [];
    public function province(){
        return $this->belongsTo(Province::class, 'matp');
    }
    public function industrial(){
        return $this->belongsTo(IndustrialArea::class, 'code');
    }
}
