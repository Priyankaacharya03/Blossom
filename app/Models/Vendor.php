<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'vendor_name',
        'vendor_email',
        'user_id',
        'city',
        'vendor_address',
        'phone_number',
        'pan_number',
        'vendor_profile_img',
        'document',
        'vendor_status',

    ];


    public function product()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(Vendor::class);
    }
}
