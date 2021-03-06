<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function checker()
    {
        return $this->belongsTo(User::class, 'checker_id', 'id');
    }

    public function checkStatus()
    {
        return $this->belongsTo(CheckStatus::class, 'check_status_id', 'id');
    }

    public function confirmer()
    {
        return $this->belongsTo(User::class, 'confirm_id', 'id');
    }

    public function useName()
    {
        return $this->belongsTo(UseModel::class, 'use_id', 'id');
    }



}
