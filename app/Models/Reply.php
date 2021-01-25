<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    public function question()
    {
        return  $this->hasMany(Reply::class);
    }

    public function likes()
    {
        return  $this->hasMany(Like::class,'reply_id','id');
    }

    public function user()
    {
        return  $this->belongsTo(User::class);
    }
}
