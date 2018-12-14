<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Loss extends Model
{
    protected $table = 'losses';

    protected $guarded = ['id'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function privateInventory()
    {
        return $this->belongsTo(PrivateInventory::class, 'private_inventory_id', 'id');
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'id');
    }

    public function checker()
    {
        return $this->belongsTo(User::class, 'checker_id', 'id');
    }
}
