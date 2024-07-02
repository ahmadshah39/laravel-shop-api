<?php

namespace App\Http\Controllers\Api\V1\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\ProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $service,
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
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = $this->service->store($request->toDto());

        return $this->success(
            data:$product,
            message: "Product created successfully...",
            code:201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $product = $this->service->get($request, $id);

        return $this->success(
            data:$product,
            message: "Product created successfully...",
            code:200
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
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
