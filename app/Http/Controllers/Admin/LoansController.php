<?php

namespace App\Http\Controllers\Admin;
use App\Models\Loan;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

class LoansController extends AdminController
{
    public function updated(Request $request){
        $loan = Loan::where('id', \request("id"))->first();
        $loan->status = $request->status;
        $loan->save();
        return redirect()->route('voyager.loans.index');
    }
}
