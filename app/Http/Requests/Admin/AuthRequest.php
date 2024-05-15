<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\Api\FailedValidation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|size:8'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Alamat :attribute harap diisi',
            'email' => 'Format email tidak sesuai',
            'exists' => 'Alamat :attribute tidak ditemukan',
            'size' => 'Panjang :attribute harus :size karakter'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return throw new FailedValidation($validator->errors());
    }

}
