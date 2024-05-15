<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\Api\FailedValidation;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
        $rules = [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id'
        ];

        if ($this->getMethod('POST') && !$this->header('X-HTTP-Method-Override'))
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Kolom ini harap diisi',
            'exists' => 'Kategori ini tidak ditemukan',
            'max' => 'Panjang kolom ini tidak boleh lebih dari :max karakter',
            'Image' => 'File harus berupa image'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        return throw new FailedValidation($validator->errors());
    }


}
