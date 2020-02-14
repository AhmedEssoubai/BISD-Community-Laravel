<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    public $timestamps = false;
    protected $fillable = ['content', 'post_id', 'compte_id', 'date_publication'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'compte_id');
    }

    public function can_delete(User $user)
    {
        return $user->id == $this->compte_id || $user->etat == 'admin' || $user->id == $this->post->compte_id || $user->id == $this->post->groupe->admin_id;
    }

    public function can_edit(User $user)
    {
        return $user->id == $this->compte_id;
    }
}
