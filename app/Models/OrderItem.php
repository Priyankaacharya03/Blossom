<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class)->with('user');
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->with('category:id,category_name');
    }
}
