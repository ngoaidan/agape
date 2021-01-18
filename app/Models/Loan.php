<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    const STATUS_1= "New";
    const STATUS_2 = "Confirm";
    const STATUS_3 = "In Process";
    const STATUS_4 = "Paycheck";
    const STATUS_5= "Completed";
    const STATUS_0 = "Cancel";

    protected $guarded = [];

    public static function getListStatus()
    {
        return [
            self::STATUS_1 => "New",
            self::STATUS_2 => "Confirm",
            self::STATUS_3 => "In Process",
            self::STATUS_4 => "Paycheck",
            self::STATUS_5 => "Completed",
            self::STATUS_0 => "Cancel"

        ];
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function province(){
        return $this->belongsTo(Province::class, 'matp');
    }

}
