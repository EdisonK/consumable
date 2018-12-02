<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id','id');
    }
}
