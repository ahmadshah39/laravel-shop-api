<?php
namespace App\DataTransferObjects;

use App\Http\Requests\Api\Product\CategoryRequest;

readonly class CategoryDTO {


    private function __construct(
      readonly string $name,
      readonly string|null $description,
    ) {

    }

    public static function fromRequest(CategoryRequest $request): CategoryDTO {
        return new self(
            name: $request->validated('name'),
            description: $request->description,
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
