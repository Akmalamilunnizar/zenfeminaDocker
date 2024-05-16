<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DashboardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rule = [
            'type' => 'required'
        ];

        if($this->getMethod() == 'GET')
            return $rule;

        return [
            'birthDate' => 'required|date_format:Y-m-d',
            'lastDate' => 'required|date_format:Y-m-d',
            'period' => 'required|int',
            'cycle' => 'required|int',
            'is_holy' => 'required|int'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            'errors' => $validator->getMessageBag()
        ]), 400);
    }
}
