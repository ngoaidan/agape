<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\Models\Customer;
use App\Models\User;
use App\Service\AuthService;
use http\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    protected function create(SignupRequest $request)
    {
        $customer = Customer::where('phone_number', $request['phone_number'])->first();
        if(!$customer){
            $customer = Customer::create([
                'name' => $request['name'],
                'phone_number' => $request['phone_number'],
                'password' => Hash::make($request['password']),
                'enterprise_id' => $request['enterprise_id'],
                'identity_number' => $request['identity_number'],
            ]);

            $tokenResult = $this->createToken($customer);
            return response()->json($this->authService->successAuthResponse($tokenResult));

        }else{
            return response()->json($this->authService->failAuthResponse(["phone_number" => "Số điện thoại đã được sử dụng!"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
                , JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

    }

    public function login(SigninRequest $request)
    {
        $customer = Customer::Where('phone_number', $request->phone_number)
            ->first();

        if(!$customer){
            $response = ["phone_number" => "Tài khoản không tồn tại"];
            return response($this->authService->failAuthResponse($response), 403);
        }

        if (Hash::check($request->password, $customer->password)) {
            $tokenResult = $this->createToken($customer);
            return response()->json($this->authService->successAuthResponse($tokenResult));

        } else {
            $response = ['password'=>'Mật khẩu không đúng'];
            return response($this->authService->failAuthResponse($response), 403);
        }

    }

    private function createToken(Customer $customer, $remember_me = false){
        $tokenResult = $customer->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return $tokenResult;
    }


    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        $message = [
            'message' => 'Successfully logged out'
        ];
        return response()->json($message);
    }

    public function changePassword(SigninRequest $request){
        $customer = Customer::Where('phone_number', $request->phone_number)
            ->first();
        if(!$customer){
            $response = ['phone_number'=>'Số điện thoại chưa đăng ký'];
            return response($this->authService->failAuthResponse($response), 403);
        }
        try {
            $customer->password = Hash::make($request->get('password'));
            $customer->save();
            $tokenResult = $this->createToken($customer);
            return response()->json($this->authService->successAuthResponse($tokenResult));
        } catch (Exception $e) {
            return $this->repository->rpError(__('http.failed'));
        }
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function customer(Request $request)
    {
        $customerId = $request->user()->id;
        $customer = Customer::where('id',$customerId)->with('enterprise')->get();
        return response()->json($customer, 200);
    }
}
