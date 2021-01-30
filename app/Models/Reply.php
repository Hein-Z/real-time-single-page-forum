<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'question_id', 'body'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'reply_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select(array('id', 'name'));
    }
}
