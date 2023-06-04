<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'orders_item'; // Name of the database table

    protected $fillable = [
        'reference', // Add the reference field here
        'ring_id',
        'order_id',
        'amounts',
        'total_price',
        'ring_codes',
        'completed',
        'created_at',
        'updated_at',
    ];
}
