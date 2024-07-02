<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table= 'products';

    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'stock',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the post that owns the comment.
     */
    public function categories(): BelongsToMany
    {
       return $this->belongsToMany(ProductCategory::class, 'product_category','product_id', 'category_id');
    }
}
