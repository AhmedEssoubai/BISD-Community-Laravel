<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use \App\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
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
     * Create a new post instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Post
     */
    public function store()
    {
        $data = request()->validate([
            'groupe_id' => 'required',
            'titre' => 'required',
            'content' => 'required',
            'image' => ['required', 'image']
        ]);

        $path = $data['image']->store('uploads', 'public');

        $id = Auth::id();

        Post::create([
            'titre' => $data['titre'],
            'content' => $data['content'],
            'groupe_id' => $data['groupe_id'],
            'image' => $path,
            'compte_id' => $id
        ]);

        return redirect()->route('groupe.show', ['groupe' => 1]);
    }

    /**
     * Show a groupe
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($post)
    {
        return view('post.show', ['post' => Post::findOrFail($post), 'user' => Auth::id()]);
    }

    public function favorite($id)
    {
        $post = Post::find($id);

        // return response()->json(empty($post->favorises_user()->find(Auth::id())));

        $f = $post->favorises()->find(Auth::id());

        if (empty($f)) {
            $post->favorises()->attach(Auth::id());
            return response()->json(['message' => 'Le post a été aimé avec succès'], 200);
        } else {
            $f->delete();
            return response()->json(['message' => 'Le post a été - avec succès'], 200);
        }
        return response()->json(['message' => 'Le post a été d\'aimé à l\'avance'], 200);
    }
}
