<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Models\Like;
use App\Models\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['getAllLikes']]);
    }

    public function like(Reply $reply)
    {
        $reply->likes()->updateOrCreate([
            "user_id" => auth()->user()->id
        ], ['user_id' => auth()->user()->id]);

        broadcast(new LikeEvent($reply->id, 'like'))->toOthers();


        return response('Like');
    }

    public function unlike(Reply $reply)
    {
        $reply->likes()->where('user_id', auth()->user()->id)->first()->delete();
        broadcast(new LikeEvent($reply->id, 'unlike'))->toOthers();
        return response('Unlike');
    }

//    public function getAllLikes(Reply $reply)
//    {
//        $likes = $reply->likes;
////        broadcast(new LikeEvent($reply->id, 'unlike'))->toOthers();
//        return response()->json($likes);
//    }
}
