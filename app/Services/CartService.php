<?php

namespace App\Services;

use App\Models\Cart;
use App\DataTransferObjects\CartDTO;

class CartService extends BaseService
{
    public function store(CartDTO $dto):Cart
    {
        return Cart::create([
            'user_id' => $dto->user_id,
            'product_id' => $dto->product_id,
            'quantity' => $dto->quantity,
        ]);
    }

    public function update(CartDTO $dto, int $id):int
    {
        return Cart::where('id', $id)->update($dto->notEmptyAttributes());
    }

    public function get($requestParams, $id=null)
    {
        if ($id !== null) {
            return Cart::where('id', $id)->first();
        }

        // filter

        return Cart::paginate('20');
    }

    public function delete($requestParams, $id)
    {
        return Cart::where('id', $id)->delete();
    }

}
