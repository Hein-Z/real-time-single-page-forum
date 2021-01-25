<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    public function question()
    {
        $this->hasMany(Reply::class);
    }

    public function likes()
    {
        $this->hasMany(Like::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
