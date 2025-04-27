<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name',
        'status',
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }
}
