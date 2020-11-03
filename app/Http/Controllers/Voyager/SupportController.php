<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Support;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Models\Post;

class SupportController extends VoyagerBaseController
{

    public function publish(){
        $support = Support::where('id', \request("id"))->first();
        $support->status = $support->status=="COMPLETED"?"CANCEL":"COMPLETED";
        $support->save();
        return redirect(route('voyager.supports.index'));
    }
}
