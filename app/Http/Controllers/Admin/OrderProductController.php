<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Models\Order;

class OrderProductController extends AdminController
{
    public function updated(Request $request){
        $order = Order::where('id', \request("id"))->first();
        $order->status = $request->status;
        $order->save();
        return redirect()->route('voyager.orders.index');
    }
}
