<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Customer;
use TCG\Voyager\Http\Controllers\VoyagerBaseController;
use TCG\Voyager\Models\Post;

class CustomerController extends VoyagerBaseController
{

    public function publish(){
        $customer = Customer::where('id', \request("id"))->first();
        $customer->status = $customer->status=="BLOCK"?"ACCEPT":"BLOCK";
        $customer->save();
        return redirect(route('voyager.customers.index'));
    }
}
