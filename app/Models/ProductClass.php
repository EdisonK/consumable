<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductClass extends Model
{
    protected $table = 'classes';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'class_id','id');
    }
}
