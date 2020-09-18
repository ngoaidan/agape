<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLoanRequest;
use App\Models\Customer;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::find(Auth::id());
        return response()->json($customer->loans, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanRequest $request)
    {
        $customerId = Auth::id();
        $loans = Loan::where('customer_id', '=', $customerId)->get();
        foreach ($loans as $loan){
            $today = Carbon::today();
            $create = new Carbon($loan->created_at);
            $checkDate = $create->addMonth($loan->term);
            if($checkDate>$today){
                return response()->json([
                    [
                        'errors' => ['error' => 'Bạn đang trong một gói vay khác!']
                    ]
                ], 200);
            }
        }
        $newLoan = Loan::create([
            'customer_id' => $customerId,
            'loan' => $request['loan'],
            'term' => $request['term'],
            'salary' => $request['salary'],
            'matp' => $request['matp'],
        ]);
        return response()->json($newLoan, 200);
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
