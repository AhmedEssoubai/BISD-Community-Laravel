<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    protected $table = 'posts';
    public $timestamps = false;
    protected $fillable = ['titre', 'content', 'image', 'compte_id', 'groupe_id', 'date_publication'];

    public function groupe()
    {
        return $this->belongsTo(Groupe::class);
    }

    /**
     * The post can be published by one user
     */
    public function compte()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favorited_users()
    {
        return $this->belongsToMany(User::class, 'favorises', 'post_id', 'compte_id');
    }

    public function bookmarked_users()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'post_id', 'compte_id');
    }

    public function is_liked()
    {
        return !empty($this->favorited_users()->find(Auth::id()));
    }

    public function is_bookmarked()
    {
        return !empty($this->bookmarked_users()->find(Auth::id()));
    }

    public function can_delete(User $user)
    {
        return $user->id == $this->compte->id || $user->etat == 'admin' || $user->id == $this->groupe->admin_id;
    }

    public function can_edit(User $user)
    {
        return $user->id == $this->compte->id;
    }
}
