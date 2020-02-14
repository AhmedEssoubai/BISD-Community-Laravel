<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class BookmarksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('pending');
    }

    /**
     * Show a post
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(User $user)
    {
        //return response()->json(['posts' => $user->bookmarked_posts, 'user' => $user], 200);
        return view('bookmark.show', ['posts' => $user->bookmarked_posts]);
    }
}
