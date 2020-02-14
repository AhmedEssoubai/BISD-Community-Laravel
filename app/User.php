<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'image', 'niveau', 'etat'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The user posts
     * 
     */
    public function posts()
    {
        return $this->hasMany(Post::class, 'compte_id', 'id')->orderBy('id', 'DESC');
    }

    /*public function groups_posts()
    {
        $posts = DB::table('user')
        ->join('appartenires', 'users.id', '=', 'appartenires.user_id')
        ->join('groupe', 'appartenires.groupe_id', '=', 'groupe.id')
        ->join('posts', 'groupe.id', '=', 'posts.groupe_id')
        ->where('users.id', $this->id)
        ->orderBy('posts.id', 'desc')
        ->get();
        dd($posts);
        //dd($this->founding_groupes()->union($this->joined_groupes())->get());
        return false;
    }*/


    public function favorites_posts()
    {
        return $this->belongsToMany(Post::class, 'favorises', 'compte_id', 'post_id');
    }

    public function bookmarked_posts()
    {
        return $this->belongsToMany(Post::class, 'bookmarks', 'compte_id', 'post_id');
    }

    /**
     * The groupes the user founded
     */
    public function founding_groupes()
    {
        return $this->hasMany(Groupe::class, 'admin_id', 'id');
    }

    /**
     * User can belong to a groups and can be an admin of a group
     */
    public function joined_groupes()
    {
        return $this->belongsToMany(Groupe::class, 'appartenires')->withPivot(['etat']);
    }

    /**
     * All the groupes of a user
     */
    public function groupes()
    {
        //return array_merge($this->founding_groupes()->get() ?? [], $this->joined_groupes()->get() ?? []);
        return $this->founding_groupes();
    }

    public function is_admin()
    {
        return $this->etat == 'admin';
    }

    /**
     * Get the posts of a user that the auth user can see
     */
    /*public function auth_posts()
    {
        return $this->posts();
    }*/
}
