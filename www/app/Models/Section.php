<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'user_id'];

    protected $hidden = ['user_id'];

    protected $appends = ['user'];

    public function getUserAttribute()
    {
        return $this->user()->first();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
