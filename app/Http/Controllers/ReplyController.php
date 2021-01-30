<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Reply;
use App\Notifications\ReplyNotification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        $replies = $question->replies;
        return response()->json($replies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Question $question)
    {
        $request->validate(["body" => 'required']);
        $reply = $question->replies()->create(['body' => $request->body, 'user_id' => auth()->user()->id]);
        $user = $reply->question->user;

        $user->notify(new ReplyNotification($reply));
        return response()->json(['reply' => $reply, 'question' => $reply->question]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Reply $reply)
    {
        return \response()->json($reply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Reply $reply)
    {
        $updated = $reply->update($request->all());

        return \response()->json([$request->all(), $question, $reply]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        return \response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
