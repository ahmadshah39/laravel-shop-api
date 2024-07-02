<?php

namespace App\Http\Requests\Api\Cart;

use Illuminate\Foundation\Http\FormRequest;
use App\DataTransferObjects\CartDTO;
use App\Models\Cart;

class CartRequest extends FormRequest
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
            'user_id' => 'required|int',
            'product_id' => 'required|int',
            'quantity'=>'required|int'
        ];
    }

    public function toDto()
    {
        return CartDTO::fromRequest($this);
    }
}
