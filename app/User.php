<?php

namespace App;

use App\Models\Loss;
use App\Models\Order;
use App\Models\Role;
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
        'on'
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

    public function confirmOrders()
    {
        return $this->hasMany(Order::class, 'confirm_id', 'id');
    }

    public function lossProducts()
    {
        return $this->hasMany(Loss::class, 'creator_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany( Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function isAdmin()
    {
        $bool = $this->roles->contains(function ($value, $key) {
            return $value->name == '管理员';
        });
        return $bool;
    }

    public function isForbid()
    {
        if($this->on == 0){
            return true;
        }else{
            return false;
        }
    }
}
