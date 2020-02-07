<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'prenom', 'email', 'password', 'image', 'niveau'
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
        return $this->hasMany(Post::class)->orderBy('date_publication', 'DESC');
    }


    public function favorites_posts()
    {
        return $this->belongsToMany(User::class, 'favorises', 'compte_id', 'post_id');
    }

    /**
     * User can belong to a group and can be an admin of a group
     */
    /*public function groupe()
    {
        return $this->belongsToMany('App\Groupe', 'appartenire')->withPivot(['type']);
    }*/
}
