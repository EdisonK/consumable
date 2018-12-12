<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateInventory extends Model
{
    protected $table = 'private_inventories';

    protected $guarded = ['id'];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
