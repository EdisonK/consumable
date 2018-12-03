<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckStatus extends Model
{
    protected $table = 'check_status';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function orders()
    {
        return $this->hasMany(Order::class,'check_status_id','id');
    }
}
