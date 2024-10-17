<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'address',
        'province',
        'city',
        'barangay',
        'phone',
        'product_id',
        'product_title',
        'quantity',
        'price',
        'image',
        'payment_status',
        'delivery_status'
    ];
}
