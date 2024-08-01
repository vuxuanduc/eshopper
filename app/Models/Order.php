<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_order_id',
        'total_price',
        'order_date',
        'receiver',
        'phone',
        'email',
        'address',
        'code_bill'
    ];
}
