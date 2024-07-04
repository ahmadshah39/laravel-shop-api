<?php
namespace App\DataTransferObjects;

use App\Http\Requests\Api\Order\OrderRequest;

readonly class OrderDTO {


    private function __construct(
       readonly int $user_id,
       readonly int $amount,
       readonly string $address,
       readonly string $payment_status,
       readonly string $products,
       readonly string $status,
    ) {

    }

    public static function fromRequest(OrderRequest $request): OrderDTO {
        return new self(
            user_id: $request->validated('user_id'),
            amount: $request->validated('amount'),
            address: $request->validated('address'),
            payment_status: $request->validated('payment_status'),
            products: $request->validated('products'),
            status: $request->validated('status'),
        );
    }

    public function notEmptyAttributes():Array
    {
        $attributes = [];
        foreach ($this as $attr=>$value) {
            if ($value !== null)
            {
                $attributes[$attr] = $value;
            }
        }
        return $attributes;
    }

}
