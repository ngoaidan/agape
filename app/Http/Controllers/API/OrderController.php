<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Jobs\PushNotificationJob;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerId = Auth::user()->id;
        $orders = Order::where('customer_id', '=', $customerId)->with('product')->get();
        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'product_id' => 'required'
        ]);
        $product = Product::findOrFail($request['product_id']);

        $customer= Customer::find($request->user()->id);
        $order = Order::create([
            'customer_id' => $customer->id,
            'status' => Order::STATUS_NEW,
            'product_id' => $product->id,
            'billing_total' => $product->price,
            'cumulative_points' => $product->cumulative_points,
        ]);
        if($order){
            $customer->cumulative_points += $order->cumulative_points;
            $customer->save();
        }
        $deviceTokens = array($customer->device_token);
        $notify = \App\Models\Notification::create(
            [
                'topic' => 'ORDER',
                'title' => 'Đặt hàng thành công!',
                'body' => 'Đơn hàng '. $product->name .' của bạn đang được xử lý.',
            ]
        );

        PushNotificationJob::dispatch('sendBatchNotification', [
            $deviceTokens,
            [
                'topicName' => $notify->topic,
                'title' => $notify->title,
                'body' => $notify->body,
            ],
        ]);
//        return $customer;
        return response()->json($order, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
