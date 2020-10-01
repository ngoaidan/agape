<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarRequest;
use App\Http\Resources\CategoryNonChildrenResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\OrderResource;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customerId = Auth::id();
        $customer = Customer::where('id',$customerId)->with('enterprise')->first();
        return new CustomerResource($customer);
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
        $request->validate([
            'name' => ['string', 'max:255'],
            'phone_number' => ['numeric'],
            'identity_number' => ['numeric', 'digits_between:6,11'],
            'enterprise_id' => ['numeric'],
        ]);
        $request['birth'] = Carbon::parse($request['birth'])->format('Y-m-d');
        $customer = Customer::find(Auth::id());
        $hasPhone = Customer::where('phone_number', '=',$request['phone_number'])->first();
        if($hasPhone){
            return response()->json(['errors'=>['error'=>'Số điện thoại đã tồn tại']]);
        }
        try{
            $customer->update($request->all());
        }catch (\Exception $exception){
            return response()->json([
                'errors' => [
                    'error'=>$exception->getMessage()
                ],
            ]);
        }
        return new CustomerResource($customer);
    }

    public function uploadAvatar(AvatarRequest $request){

        $customer = Customer::find(Auth::id());

        if ($request->hasfile('avatar')) {
            $customer->uploadImage(request()->file('avatar'), 'avatar');
            $customer->save();
            return new CustomerResource($customer);
        }
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

    public function orderServices(){
        $customer = Customer::find(Auth::id());

    }

    public function orderProducts(){
        $orders = Order::where("customer_id", "=", Auth::id())->get();
        return OrderResource::collection($orders);
    }

    public function getCumulativePoints(){
        $customer = Customer::findOrFail(Auth::id());
        $myOrderProducts = $customer->orders;
        $myOrderServices = $customer->orderServices;

        $idProducts = array();
        $idServices = array();
        $idCategories = array();

        foreach ($myOrderProducts as $myOrderProduct){
//            if(!in_array($myOrderProduct->product_id, $idProducts, true)){
                array_push($idProducts, $myOrderProduct->product_id);
//            }
        }

        foreach ($myOrderServices as $myOrderService){
//            if(!in_array($myOrderService->service_id, $idServices, true)){
                array_push($idServices, $myOrderService->service_id);
//            }
        }

        $products = Product::whereIn('id', $idProducts)->get('category_id');
        $services = Service::whereIn('id', $idServices)->get('category_id');

        foreach ($products as $product){
            if(!in_array($product->category_id, $idCategories, true)){
                array_push($idCategories, $product->category_id);
            }
        }
        foreach ($services as $service){
            if(!in_array($service->category_id, $idCategories, true)){
                array_push($idCategories, $service->category_id);
            }
        }
        $categories = Category::whereIn('id', $idCategories)->get();
//        foreach ($categories as $category){
//            if(in_array()){
//
//            }
//        }
        return $data = array(
            'cumulative_total' => $customer->cumulative_points,
            'categories' => CategoryNonChildrenResource::collection($categories)
        );
    }
}
