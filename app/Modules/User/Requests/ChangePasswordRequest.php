<?php

namespace App\Modules\User\Requests;

use App\Services\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePasswordRequest extends FormRequest
{
    protected ApiResponse $apiResponse;

    public function __construct(ApiResponse $apiResponse)
    {
        parent::__construct();
        $this->apiResponse = $apiResponse;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => ['nullable', Password::defaults(), 'confirmed'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->apiResponse->validationFailed($validator->errors()->toArray())
        );
    }
}
