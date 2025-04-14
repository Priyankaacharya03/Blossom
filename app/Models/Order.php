<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'total_amount',
        'order_status',
        'payment_method',
        'user_id',
        'shipping_address_id',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
