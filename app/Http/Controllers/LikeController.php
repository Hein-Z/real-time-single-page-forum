<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Reply $reply)
    {
        $reply->likes()->updateOrCreate([
//            auth()->user()->id
            "user_id" => 1
        ], ['user_id' => 1]);
        return response('Like');
    }

    public function unlike(Reply $reply)
    {
        $reply->likes()->where('user_id', 1)->delete();
        return response('Unlike');
    }

    public function getAllLikes(Reply $reply)
    {
        $likes = $reply->likes;
        return response()->json($likes);
    }
}
