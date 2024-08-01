<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name_product',
        'description',
        'avatar',
        'price',
        'new_price',
        'has_variants',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
