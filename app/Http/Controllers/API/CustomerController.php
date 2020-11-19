<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarRequest;
use App\Http\Resources\CategoryNonChildrenResource;
use App\Http\Resources\CustomerResource;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\Product;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;

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
     * @return CustomerResource
     */
    public function show($id)
    {
        $id = Auth::id();
        $customer = Customer::where('id',$id)->with('enterprise')->first();
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['string', 'max:255'],
            'identity_number' => ['numeric', 'digits_between:6,11'],
            'enterprise_id' => ['numeric'],
        ]);
        $request['birth'] = Carbon::parse($request['birth'])->format('Y-m-d');
        $customer = Customer::find(Auth::id());

        try{
            $customer->update([
                'name' => $request['name'],
                'birth' => $request['birth'],
                'sex' => $request['sex'],
                'matp' => $request['matp'],
                'makcn' => $request['makcn'],
                'enterprise_id' => $request['enterprise_id'],
                'identity_number' => $request['identity_number'],
            ]);
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

//    public function orderServices(){
//        $customer = Customer::find(Auth::id());
//
//    }
//
//    public function orderProducts(){
//        $orders = Order::where("customer_id", "=", Auth::id())->get();
//        return OrderResource::collection($orders);
//    }

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
        $data = array(
            'cumulative_total' => $customer->cumulative_points,
            'categories' => CategoryNonChildrenResource::collection($categories)
        );

        return Response()->json($data, 200);
    }

    public function getCumulativePointsItem($idCategory){
        $idCustomer = Auth::id();
        $myOrderProducts = Order::where('customer_id', $idCustomer)->with('product')->get();
        $myOrderServices = OrderService::where('customer_id', $idCustomer)->with('service')->get();

        $data = array();
        foreach ($myOrderProducts as $myOrderProduct){
            $item = [
                'item' => $myOrderProduct->product->name,
                'thumbnail' => Voyager::image($myOrderProduct->product->thumbnail('cropped')),
                'cumulative_points' => $myOrderProduct->cumulative_points,
                'type' => 'product',
                'date_order' => $myOrderProduct->created_at,
            ];
            array_push($data, $item);
        }

        foreach ($myOrderServices as $orderService){
            $item = [
                'item' => $orderService->service->title,
                'thumbnail' => Voyager::image($orderService->service->thumbnail('cropped')),
                'cumulative_points' => $orderService->cumulative_points,
                'type' => 'service',
                'date_order' => $orderService->created_at,
            ];
            array_push($data, $item);
        }
        usort($data, function ($a, $b) {
            return strcmp($a['date_order'], $b['date_order']);
        });
        return Response()->json($data);

    }




}
