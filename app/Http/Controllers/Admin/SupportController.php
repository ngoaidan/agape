<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends AdminController
{
    public function updated(Request $request){
        $support = Support::where('id', \request("id"))->first();
        $support->status = $request->status;
        $support->save();
        return back();
    }
}
