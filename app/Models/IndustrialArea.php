<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustrialArea extends Model
{
    protected $table = 'industrial_areas';
    protected $guarded = [];
    public function enterprises(){
        return $this->hasMany(Enterprise::class, 'code', 'code');
    }
}
