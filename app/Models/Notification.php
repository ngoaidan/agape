<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    const TOPIC_PROMO = "PROMO";
    const STATUS_ALERT = "ALERT";
    const STATUS_ORDER = "ORDER";

    protected $guarded = [];


}
