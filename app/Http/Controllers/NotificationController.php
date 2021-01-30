<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function getNoti()
    {
        return response()->json([
            'notifications' => auth()->user()->notifications,
        ]);
    }

    public function markAsRead($id)
    {
        auth()->user()->notifications->where('id', $id)->markAsRead();
        return response()->json([]);
    }
}
