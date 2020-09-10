<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'devvn_tinhthanhpho';
    protected $primaryKey = 'matp';
    protected $guarded = [];
    public $incrementing = false;

    public function enterprises(){
        return $this->hasMany(Enterprise::class, 'matp', 'matp');
    }
}
