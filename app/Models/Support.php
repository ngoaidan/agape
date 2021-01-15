<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    const STATUS_NEW = "NEW";
    const STATUS_COMPLETED = "COMPLETED";
    const STATUS_CANCEL = "CANCEL";

    protected $guarded = [];
}
