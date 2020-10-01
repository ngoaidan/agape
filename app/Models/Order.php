<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_NEW = 2;
    const STATUS_INPROCESS = 3;
    const STATUS_COMPLETED = 1;
    const STATUS_CANCELLED = 0;

    protected $guarded = [];

    public static function getListStatus()
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_INPROCESS => 'In Process',
            self::STATUS_COMPLETED => 'Complete',
            self::STATUS_CANCELLED => 'Cancel'
        ];
    }

//    public static function getStatusName($statusId)
//    {
//        $listStatus = self::getListStatus();
//
//        return $listStatus[$statusId] ?? null;
//    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function statusName(){
        $listStatus = self::getListStatus();
        return $listStatus[$this->status] ?? null;
    }
}
