<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Enterprise;
use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getProvinces(){
        return $provinces = Province::with('enterprises')->get();
        return $enterprises = Enterprise::all()[0]->province;
        return response()->json($provinces, 200);
    }
}
