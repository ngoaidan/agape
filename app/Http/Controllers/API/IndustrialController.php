<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\IndustrialArea;
use Illuminate\Http\Request;

class IndustrialController extends Controller
{
    public function index()
    {
        return IndustrialArea::all();
    }
    public function getEnterprise(){
        return $enterprises = IndustrialArea::with('enterprise')->get();
    }
}
