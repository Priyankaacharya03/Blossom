<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function productDetails($id)
    {
        // $items = OrderItem::whereIn('product')
        // dd($id);
    }

    // public function product()
    // {
    //     return $this->belongsTo(OrderItem::class, 'product_id', 'id');
    // }

    public function shippingAddress()
    {
        return $this->hasOne(ShippingAddress::class, 'order_id');
    }
}
