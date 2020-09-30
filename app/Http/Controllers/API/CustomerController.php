<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AvatarRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Service\CustomerService;
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
}
