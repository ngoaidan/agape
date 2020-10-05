<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function store(Request $request){
        Support::create([
            "matp" => $request['matp'],
            "enterprise_id" => $request['enterprise_id'],
            "name" => $request['name'],
            "phone_number" => $request['phone_number'],
            "note" => $request['note'],
        ]);

        return Response()->json([
            'success' => 'Tạo yêu cầu thành công'
        ]);
    }
}
