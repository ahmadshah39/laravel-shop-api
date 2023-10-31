<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $table= 'product_variation';

    protected $fillable = [
        'id',
        'product_id',
        'variation_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
