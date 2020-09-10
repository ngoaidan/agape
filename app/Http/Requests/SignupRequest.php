<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:6'],
            'identity_number' => ['required', 'numeric', 'digits_between:6,11'],
            'enterprise_id' => ['required', 'numeric'],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json(
            [
                'errors' => $errors,
                'status_code' => 422,
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên người dùng',
            'phone_number.required' => 'Vui lòng nhập số điện thoại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'identity_number.required' => 'Vui lòng nhập  số chứng minh nhân dân hoặc căn cước',
            'identity_number.numeric' => 'Số chứng minh nhân dân hoặc căn cước chưa chính xác',
            'identity_number.digits_between' => 'Số chứng minh nhân dân hoặc căn cước chưa chính xác',
        ];
    }
}
