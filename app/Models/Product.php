<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table= 'product';

    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'in_stock',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
