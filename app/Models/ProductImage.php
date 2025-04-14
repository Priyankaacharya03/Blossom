<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = [
        'product_image',
        'is_primary',
        'product_id',

    ];

    // A product image belongs to one product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
