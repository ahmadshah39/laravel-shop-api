<?php

namespace App\Services;

use App\Models\Category;
use App\DataTransferObjects\CategoryDTO;

class CategoryService extends BaseService
{
    public function store(CategoryDTO $dto):Category
    {
        return Category::create([
            'name' => $dto->name,
            'description' => $dto->description,
        ]);
    }

    public function update(CategoryDTO $dto, int $id):int
    {
        return Category::where('id', $id)->update($dto->notEmptyAttributes());
    }

    public function get($requestParams, $id=null)
    {
        if ($id !== null) {
            return Category::where('id', $id)->first();
        }

        // filter

        return Category::paginate('20');
    }

    public function delete($requestParams, $id)
    {
        return Category::where('id', $id)->delete();
    }

}
