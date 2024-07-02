<?php

namespace App\Http\Controllers\Api\V1\Client\Product;

use App\Http\Controllers\Controller;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $service,
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
}
