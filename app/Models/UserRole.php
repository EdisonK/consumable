<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'role_user';

    protected $guarded = ['id'];

    public $timestamps = false;
}
