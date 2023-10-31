<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table= 'product_category';

    protected $fillable = [
        'id',
        'product_id',
        'category_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
