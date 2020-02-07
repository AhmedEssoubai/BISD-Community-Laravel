<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    //

    protected $table = 'Groupe';
    protected $fillable = ['label', 'icon', 'etat', 'admin_id'];

    /*public function posts() {
        return $this->hasMany(App\Post::class);
    }*/

    /**
     * Groupe have admin user
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    /**
     * Group have many members
     */
    public function members()
    {
        return $this->belongsToMany('App\User', 'appartenire');
    }

    /**
     * Group have many posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('id', 'DESC');
    }
}
