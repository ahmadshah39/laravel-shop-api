<?php

namespace App\Http\Controllers\Api\V1\Client\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\CartRequest;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        protected CartService $service,
    )
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->service->get($request);

        return $this->success(
            data:$products,
            message: "Product created successfully...",
            code:200
        );
    }

        /**
     * Update the specified resource in storage.
     */
    public function update(CartRequest $request, string $id)
    {
        $product = $this->service->update($request->toDto(), $id);

        return $this->success(
            data:$product,
            message: "Product updated successfully...",
            code:201
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $product = $this->service->delete($request, $id);

        return $this->success(
            data:null,
            message: "Product deleted successfully...",
            code:201
        );
    }

}
