<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'company_id',
        'user_id',
        'days'

    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function Company()
    {
        return $this->belongsTo(Company::class);
    }
}
