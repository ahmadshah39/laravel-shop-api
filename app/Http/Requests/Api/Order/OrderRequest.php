<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;
use App\DataTransferObjects\OrderDTO;
use App\Models\Order;

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
            'user_id' => 'required|int',
            'amount'  => 'required|int',
            'address'  => 'required|string',
            'payment_status'  => 'required|int',
            'products'  => 'required|string',
            'status'  => 'required|int',
        ];
    }

    public function toDto()
    {
        return OrderDTO::fromRequest($this);
    }
}
