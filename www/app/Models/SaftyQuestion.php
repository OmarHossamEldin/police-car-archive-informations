<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaftyQuestion extends Model
{
    protected $guarded = [];

    protected $hidden = [
        'user_id',
        'key'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
