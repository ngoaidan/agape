<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\OrderService;

class OrderServiceController extends AdminController
{
    public function updated(Request $request){
        $order = OrderService::where('id', \request("id"))->first();
        $order->status = $request->status;
        $order->save();
        return redirect()->route('voyager.order-services.index');
    }
}
