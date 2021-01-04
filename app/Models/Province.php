<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'devvn_tinhthanhpho';
    protected $primaryKey = 'matp';
    protected $guarded = [];
//    public $incrementing = false;

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    public static function getListStatus()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DEACTIVE => 'No active',
        ];
    }

    public static function getStatusName($statusId)
    {
        $listStatus = self::getListStatus();

        return $listStatus[$statusId] ?? null;
    }

    public function industrial_areas(){
        return $this->hasMany(IndustrialArea::class,'matp', 'matp');
    }
    public function enterprises(){
        return $this->hasMany(Enterprise::class,'matp', 'matp');
    }
    public function loans(){
        return $this->belongsTo(Loan::class, 'matp');
    }
}
