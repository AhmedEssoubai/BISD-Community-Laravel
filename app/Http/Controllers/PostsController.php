<?php

namespace App\Http\Controllers;

use App\Groupe;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use \App\Post;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $this->middleware('pending');
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
            'titre' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['required', 'image']
        ]);

        if (Groupe::findOrFail($data['groupe_id'])->is_member())
        {
            $path = $data['image']->store('uploads', 'public');
    
            $id = Auth::id();
    
            Post::create([
                'titre' => $data['titre'],
                'content' => $data['content'],
                'groupe_id' => $data['groupe_id'],
                'image' => $path,
                'compte_id' => $id
            ]);
        }
        
        return \App::make('redirect')->back();

        //return redirect()->route('groupes.show', ['groupe' => $data['groupe_id']]);
    }

    /**
     * Show a post
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($post)
    {
        return view('post.show', ['post' => Post::findOrFail($post), 'user' => Auth::id()]);
    }

    /**
     * Favorite a post or remove favorite from him if already exists
     */
    public function favorite(Post $post)
    {
        if (Groupe::findOrFail($post->groupe_id)->is_member())
            return $post->favorited_users()->toggle(Auth::user());
        
        return response()->json(['message' => 'Not a member'], 200);
        /*if (empty($post->favorited_users()->find(Auth::id()))) {
            $post->favorited_users()->attach(Auth::id());
            return response()->json(['message' => 'Le post a été aimé avec succès'], 200);
        } else {
            DB::table('favorises')->where('compte_id', Auth::id())->where('post_id', $post->id)->delete();
            return response()->json(['message' => 'Le post a été - avec succès'], 200);
        }*/
    }

    /**
     * Bookmark a post or remove it from bookmark list if already exists
     */
    public function bookmark(Post $post)
    {
        $g = Groupe::findOrFail($post->groupe_id);
        if ($g->is_public() || $g->is_member())
            return $post->bookmarked_users()->toggle(Auth::user());
        
        return response()->json(['message' => 'Not a member'], 200);
        /*if (empty($post->bookmarked_users()->find(Auth::id()))) {
            $post->bookmarked_users()->attach(Auth::id());
            return response()->json(['message' => 'Le post été ajouté à la liste des signets avec succès'], 200);
        } else {
            DB::table('bookmarks')->where('compte_id', Auth::id())->where('post_id', $post->id)->delete();
            return response()->json(['message' => 'La post a bien été supprimée de la liste des signets'], 200);
        }*/
    }

    /**
     * Show the edit post form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('post.edit', ['post' => $post]);
    }

    /**
     * Update a post
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Post $post)
    {
        $this->authorize('update', $post);

        $data = request()->validate([
            'titre' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['image']
        ]);

        if (!empty($data['image']))
        {
            Storage::delete($post->image);
            $image = ['image' => ($data['image']->store('uploads', 'public'))];
        }

        $post->update(array_merge($data, $image ?? []));
        
        return redirect()->route('posts.show', ['post' => $post]);
    }

    /**
     * Delete a post
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $id = $post->groupe_id;

        $post->delete();
        
        return redirect('/groupes/' . $id);
    }
}
