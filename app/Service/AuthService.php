<?php


namespace App\Service;


use Illuminate\Support\Carbon;

class AuthService
{
    public function successAuthResponse($tokenResult){
        return [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ];
    }

    public function failAuthResponse($message, $statusCode = 403){

        return [
                'errors' => $message,
                'status_code' => $statusCode,
            ];
    }

}
