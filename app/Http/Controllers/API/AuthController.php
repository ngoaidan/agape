<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $customer = Customer::Where('phone_number', $request->phone_number)
            ->first();
        if($customer){
            if (Hash::check($request->password, $customer->password)) {
                $tokenResult = $customer->createToken('Personal Access Token');
                $token = $tokenResult->token;
                if ($request->remember_me)
                    $token->expires_at = Carbon::now()->addWeeks(1);
                $token->save();
                return response()->json([
                    'access_token' => $tokenResult->accessToken,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString()
                ]);

            } else {
                $response = ['Mật khẩu không đúng'];
                return response($response, 422);
            }
        }else {
            $response = ['Tài khoản không tồn tại'];
            return response($response, 422);
        }

    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
//        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function customer(Request $request)
    {
        return response()->json($request->user());
    }
}
