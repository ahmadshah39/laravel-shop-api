<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationType extends Model
{
    use HasFactory;

    protected $table= 'variation_type';

    protected $fillable = [
        'id',
        'name',
        'alias',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
