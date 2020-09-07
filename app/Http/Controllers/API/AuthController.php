<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected function create(SignupRequest $request)
    {
        $customer = Customer::where('phone_number', $request['phone_number'])->first();
        if(!$customer){
            $customer = Customer::create([
                'name' => $request['name'],
                'phone_number' => $request['phone_number'],
                'password' => Hash::make($request['password']),
            ]);

            return $customer;
        }else{
            return response()->json(
                [
                    'error' => 'Số điện thoại đã được sử dụng!',
                    'status_code' => 422,
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

    }

    public function login(SigninRequest $request)
    {
        $user = Customer::Where('phone_number', $request->phone_number)
            ->first();
        if($user){
            if (Hash::check($request->password, $user->password)) {
                return 'login success';
//                $tokenResult = $user->createToken('Personal Access Token');
//                $token = $tokenResult->token;
//                if ($request->remember_me)
//                    $token->expires_at = Carbon::now()->addWeeks(1);
//                $token->save();
//                return response()->json([
//                    'access_token' => $tokenResult->accessToken,
//                    'expires_at' => Carbon::parse(
//                        $tokenResult->token->expires_at
//                    )->toDateTimeString()
//                ]);

            } else {
                $response = ['Mật khẩu không đúng'];
                return response($response, 422);
            }
        }else {
            $response = ['Tài khoản không tồn tại'];
            return response($response, 422);
        }

    }
}
