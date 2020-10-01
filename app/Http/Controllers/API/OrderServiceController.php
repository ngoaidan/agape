<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderServiceResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderServiceController extends Controller
{
    public function store(Request $request){
        $validator = $request->validate([
            'service_id' => 'required'
        ]);
        $service = Service::findOrFail($request['service_id']);

        $customer= Customer::find($request->user()->id);
        $orderService = OrderService::create([
            'customer_id' => $customer->id,
            'status' => Order::STATUS_NEW,
            'service_id' => $service->id,
            'billing_total' => $service->price,
            'cumulative_points' => $service->cumulative_points
        ]);
        if($orderService){
            $customer->cumulative_points += $orderService->cumulative_points;
            $customer->save();
        }
//        return $customer;
        return response()->json($orderService, 200);
    }

    public function index(){
        $customerId = Auth::user()->id;
        $orderServices = OrderService::where('customer_id', '=', $customerId)->with('service')->get();
        return OrderServiceResource::collection($orderServices);
    }
}
