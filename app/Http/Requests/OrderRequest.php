<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'products' => ['required', 'array'],
            'products.*.name' => ['required', 'string'],
            'products.*.price' => ['required', 'numeric', 'min:0'],
            'products.*.code' => ['required', 'string',],
            "street" => ['required', "string"],
            'city' => ['required', 'string'],
            'state' => ['required', "string"],
            'buyerName' => ['required'],
            'buyerPhone' => ['required'],
            "buyerEmail" => ['required', "email"],
            'number' => 'required|numeric'

        ];
    }
}
