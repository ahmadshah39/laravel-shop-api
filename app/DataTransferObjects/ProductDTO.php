<?php
namespace App\DataTransferObjects;

use App\Http\Requests\Api\Product\ProductRequest;

readonly class ProductDTO {


    private function __construct(
      readonly string $title,
      readonly string|null $description,
      readonly string|null $image,
      readonly int|null $stock,
      readonly int|null $price,
      readonly Array|null $category_ids,
    ) {

    }

    public static function fromRequest(ProductRequest $request): ProductDTO {
        return new self(
            title: $request->validated('title'),
            description: $request->description,
            image: $request->image,
            stock: $request->stock,
            price: $request->price,
            category_ids: $request->category_ids,
        );
    }

    public function notEmptyAttributes():array
    {
        $attributes = [];
        foreach ($this as $attr=>$value) {
            if ($value !== null && $attr !== 'category_ids')
            {
                $attributes[$attr] = $value;
            }
        }
        return $attributes;
    }

}
