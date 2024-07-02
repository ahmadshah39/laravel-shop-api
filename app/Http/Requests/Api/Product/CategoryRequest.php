<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;
use App\DataTransferObjects\CategoryDTO;
use App\Models\Category;

class CategoryRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:categories',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH']))
        {
            $rules['name'] = 'required|string|max:255|unique:categories,name,'. $this->route()->parameter('id');
        }

        return $rules;
    }

    public function toDto()
    {
        return CategoryDTO::fromRequest($this);
    }
}
