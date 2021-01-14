<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
//use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;//, Notifiable;

    protected $guarded=[];

    protected $hidden = [
        'password','api_token'
    ];
    
    public function ApiTokenGenerater()
    {
        // to GenerateAccessToken
        $this->api_token = Str::random(60);
        $this->save();
        return $this->api_token;
    }
    public function SaftyQuestion()
    {
        return $this->hasOne(SaftyQuestion::class);
    }
}
