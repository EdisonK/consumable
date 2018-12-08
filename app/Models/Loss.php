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
}
