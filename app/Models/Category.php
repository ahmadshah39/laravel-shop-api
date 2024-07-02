<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table= 'categories';

    protected $fillable = [
        'id',
        'name',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Get the post that owns the comment.
     */
    public function products(): BelongsToMany
    {
       return $this->belongsToMany(ProductCategory::class, 'product_category','category_id', 'product_id');
    }
}
