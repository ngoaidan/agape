<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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
        $customer = Customer::where('id',$customerId)->with('enterprise')->get();
        return response()->json($customer, 200);
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
        $hasPhone = Customer::where('phone_number', '=',$request['phone_number'])->get();
//        if($hasPhone && ){
//            return response()->json(['errors'=>['error'=>'Số điện thoại đã tồn tại']]);
//        }
        try{
            $customer->update($request->all());
        }catch (\Exception $exception){
            return response()->json([
                'errors' => [
                    'error'=>$exception->getMessage()
                ],
            ]);
        }
        return $customer;
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