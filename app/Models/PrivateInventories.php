<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivateInventories extends Model
{
    protected $table = 'private_inventories';

    protected $guarded = ['id'];

    public $timestamps = false;
}
