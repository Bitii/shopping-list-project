<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if ($this->method() == 'PATCH') {
            return [
                'category' => 'nullable|string|min:2',
                'name' => 'nullable|string|min:3',
                'description' => 'nullable|string|min:10',
                'picture' => 'nullable|string|min:20',
                'price' => 'nullable|numeric',
                'stock' => 'nullable|numeric',
            ];
        }
        return [
            'category' => 'required|string|min:2',
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:10',
            'picture' => 'required|string|min:20',
            'price' => 'required|numeric',
            'stock' => 'nullable|numeric',
        ];
    }
}
