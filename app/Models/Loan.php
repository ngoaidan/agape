<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    const STATUS_NEW = 1;
    const STATUS_CONFIRM = 2;
    const STATUS_INPROCESS = 3;
    const STATUS_PAYCHECK = 4;
    const STATUS_COMPLETED = 5;
    const STATUS_CANCELLED = 0;


    protected $guarded = [];

    public static function getListStatus()
    {
        return [
            self::STATUS_NEW => "New",
            self::STATUS_CONFIRM => "Confirm",
            self::STATUS_INPROCESS => "In Process",
            self::STATUS_PAYCHECK => "Paycheck",
            self::STATUS_COMPLETED => "Completed",
            self::STATUS_CANCELLED => "Cancel"

        ];
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function province(){
        return $this->belongsTo(Province::class, 'matp');
    }

}
