<?php

namespace App;

use App\Models\Loss;
use App\Models\Order;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'middle_name',
        'last_name',
        'city',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

//    public function tasks()
//    {
//        return $this->hasMany(Task::class);
//    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);

    }

    public function createOrders()
    {
        return $this->hasMany(Order::class, 'creator_id', 'id');
    }

    public function checkOrders()
    {
        return $this->hasMany(Order::class, 'checker_id', 'id');
    }

    public function lossProducts()
    {
        return $this->hasMany(Loss::class, 'creator_id', 'id');
    }
}
