<?php

namespace App\Modules\Biodata\Requests;

use App\Services\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BiodataRequest extends FormRequest
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
            'name' => 'required|string',
            'phone' => [
                'required',
                'regex:/^(?:\+62|62|0)8[1-9][0-9]{6,9}$/',
            ],
            'pob' => 'required|string',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female',
            'user_id' => 'required|integer|exists:users,id',
            'religion_id' => 'required|integer|exists:religions,id',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->apiResponse->validationFailed($validator->errors()->toArray())
        );
    }
}
