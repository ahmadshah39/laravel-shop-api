<?php

namespace App\Services;

use App\Models\Order;
use App\DataTransferObjects\OrderDTO;

class OrderService extends BaseService
{
    public function store(OrderDTO $dto):Order
    {
        return Order::create([
            'user_id' => $dto->user_id,
            'amount'  => $dto->amount,
            'address'  => $dto->address,
            'payment_status'  => $dto->payment_status,
            'products'  => $dto->products,
            'status'  => $dto->status,
        ]);
    }

    public function update(OrderDTO $dto, int $id):int
    {
        return Order::where('id', $id)->update($dto->notEmptyAttributes());
    }

    public function get($requestParams, $id=null)
    {
        if ($id !== null) {
            return Order::where('id', $id)->first();
        }

        // filter

        return Order::paginate('20');
    }

    public function delete($requestParams, $id)
    {
        return Order::where('id', $id)->delete();
    }

}
