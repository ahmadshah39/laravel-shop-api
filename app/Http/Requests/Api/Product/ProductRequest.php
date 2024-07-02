<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;
use App\DataTransferObjects\ProductDTO;

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
        $rules = [
            'title' => 'required|string|max:255|unique:products',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH']))
        {
            $rules['title'] = 'required|string|max:255|unique:products,title,'. $this->route()->parameter('id');
        }

        return $rules;
    }

    public function toDto()
    {
        return ProductDTO::fromRequest($this);
    }
}
