<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'slug',
        'product_name',
        'price',
        'discount_percent',
        'description',
        'stock',
        'primary_image',
        'is_feature',
        'category_id',
        'vendor_id',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Calculate discount amount based on discount_percent
    public function getDiscountAmountAttribute()
    {
        return ($this->price * $this->discount_percent) / 100;
    }

    // Calculate actual price after discount
    public function getActualAmountAttribute()
    {
        return $this->price - $this->getDiscountAmountAttribute();
    }
}
