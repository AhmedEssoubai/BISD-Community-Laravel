<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
