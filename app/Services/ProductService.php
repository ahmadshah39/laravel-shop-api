<?php

namespace App\Services;

use App\Models\Product;
use App\DataTransferObjects\ProductDTO;

use function PHPUnit\Framework\isEmpty;

class ProductService extends BaseService
{
    public function store(ProductDTO $dto):Product
    {
        $product = Product::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'image' => $dto->image,
            'stock' => $dto->stock,
            'price' => $dto->price,
        ]);

        if(!is_null($dto->category_ids) && !isEmpty($dto->category_ids)){
            $product->categories()->sync($dto->category_ids);
        }

        return $product;
    }

    public function update(ProductDTO $dto, int $id):int
    {
        $product = Product::where('id', $id)->update($dto->notEmptyAttributes());

        if(!is_null($dto->category_ids) && !isEmpty($dto->category_ids)){
            $product->categories()->sync($dto->category_ids);
        }

        return $product;
    }

    public function get($requestParams, $id=null)
    {
        if ($id !== null) {
            return Product::where('id', $id)->first();
        }

        $category_ids = $requestParams['category_ids'] ?? null;

        $query = $requestParams['query'];

        $limit = $requestParams['limit'] ?? 20;

        $products = Product::with('category');

        if(!is_null($category_ids)){
            $products->whereHas(function($q) use($category_ids) {
                return $q->whereIn('category_id', $category_ids);
            });
        }

        if(!is_null($query) && trim($query) !== ''){
            $products->where(function($q) use($query) {
                return $q->where('title', 'LIKE', '%' . trim($query) . '%')
                         ->where('description', 'LIKE', '%' . trim($query) . '%');

            });
        }

        return $products->paginate($limit);
    }

    public function delete($requestParams, $id)
    {
        return Product::where('id', $id)->delete();
    }

    public function updateProductCategories(int $id, array $category_ids):bool
    {
        $product = Product::where('id', $id)->first();

        if(!is_null($product)){
            $product->categories()->sync($category_ids);
            return true;
        }

        return false;
    }

}
