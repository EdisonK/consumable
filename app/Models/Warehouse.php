<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';

    public $timestamps = false;


    public function classes()
    {
        return $this->hasMany(ProductClass::class, 'warehouse_id','id');
    }
}
