<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Enterprise;
use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getProvinces(){
        return $provinces = Province::where('approval', Province::STATUS_ACTIVE)->with('enterprises')->get();

    }
}
