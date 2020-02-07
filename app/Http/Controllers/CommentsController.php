<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Create a new comment instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Post
     */
    public function create(Request $request)
    {
        /*$data = request()->validate([
            'content' => ['required', 'string', 'max:255'],
            'post_id' => 'require'
        ]);*/

        $id = Auth::id();

        return Comment::create([
            'content' => $request->input('content'),
            'post_id' => $request->input('post'),
            'compte_id' => $id
        ]);
    }
}
