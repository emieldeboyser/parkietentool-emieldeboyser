<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table='orders';

    protected $fillable = [
        'user_id',
        'reference',
        'status',
        'total_price',
        'shipping_data',
        'payment_data',
        'remarks',
        'created_at',
        'updated_at',
    ];
}
