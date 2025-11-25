<?php

namespace App\Modules\User\Requests;

use App\Services\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    protected ApiResponse $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        parent::__construct();
        $this->apiResponse = $apiResponse;
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string',
            'password' => ['nullable', Password::defaults()],
            'password_confirmation' => ['nullable', Password::defaults()],
            'username' => 'required|string|unique:users,username,' . $this->id,
            'email'    => 'required|email|unique:users,email,' . $this->id,
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->apiResponse->validationFailed($validator->errors()->toArray())
        );
    }
}
