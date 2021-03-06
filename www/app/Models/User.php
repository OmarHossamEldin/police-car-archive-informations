<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $hidden = [
        'password'
    ];

    public function SaftyQuestion()
    {
        return $this->hasOne('App\Models\SaftyQuestion');
    }
    
    /**
     * relation defines that user has many sections,
     * created by him.
     * @return void
     */
    public function section()
    {
        return $this->hasMany('App\Models\Section');
    }
}
