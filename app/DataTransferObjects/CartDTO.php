<?php
namespace App\DataTransferObjects;

use App\Http\Requests\Api\Cart\CartRequest;

readonly class CartDTO {


    private function __construct(
       readonly int $user_id,
       readonly int $product_id,
       readonly int $quantity,
    ) {

    }

    public static function fromRequest(CartRequest $request): CartDTO {
        return new self(
            user_id: $request->validated('user_id'),
            product_id: $request->validated('product_id'),
            quantity: $request->validated('quantity'),
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
