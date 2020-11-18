<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Models\Province;

class AddressController extends Controller
{
    public function getProvinces(){
        $provinces = Province::where('approval', Province::STATUS_ACTIVE)->with('industrial_areas')->get();
        return AddressResource::collection($provinces);
    }

}
