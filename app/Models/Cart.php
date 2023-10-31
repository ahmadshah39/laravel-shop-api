<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table= 'carts';

    protected $fillable = [
        'id',
        'user_id',
        'product_id',
        'quantity',
        'variations',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}