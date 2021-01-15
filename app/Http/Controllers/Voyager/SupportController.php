<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Support;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Models\Post;

class SupportController extends VoyagerBaseController
{

    public function publish(Request $request){
        $support = Support::where('id', \request("id"))->first();
//        $support->status = $support->status=="COMPLETED"?"CANCEL":"COMPLETED";
        $support->status = $request->status;
        $support->save();
        return back();
    }
}
