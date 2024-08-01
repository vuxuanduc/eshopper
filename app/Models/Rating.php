<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_item_id',
        'product_id',
        'rating',
        'content_rating',
        'rating_date',
        'is_active'
    ];
}
