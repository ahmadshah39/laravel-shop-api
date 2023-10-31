<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variation extends Model
{
    use HasFactory;

    protected $table= 'variations';

    protected $fillable = [
        'id',
        'name',
        'description',
        'variation_type_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
