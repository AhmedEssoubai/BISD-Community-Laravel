<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Groupe extends Model
{
    //

    protected $table = 'groupes';
    protected $fillable = ['label', 'icon', 'etat', 'admin_id', 'image', 'description'];

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
        return $this->belongsToMany(User::class, 'appartenires')->withPivot('etat');
    }

    /**
     * The accepted members in the group
     */
    public function real_members()
    {
        return $this->belongsToMany(User::class, 'appartenires')->where('appartenires.etat', 'accepté')->withPivot('etat');
    }

    /**
     * Groupe pending list
     */
    public function pending_members()
    {
        return $this->belongsToMany(User::class, 'appartenires')->where('appartenires.etat', 'attendre')->withPivot('etat');
    }

    /**
     * Group have many posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('id', 'DESC');
    }

    /**
     * Get the count of members in this groupe
     */
    public function members_count()
    {
        return $this->real_members()->count() + 1;
    }

    /**
     * If the user can join this groupe
     */
    public function can_join()
    {
        return $this->admin_id != Auth::id();
    }

    /**
     * Is the user in the list of pending of this groupe
     */
    public function is_pending()
    {
        $j = $this->members()->find(Auth::id());
        return !empty($j) && $j->pivot->etat == 'attendre';
        //return !empty($this->members()->find(Auth::id()));
    }

    /**
     * Is the user a member of this groupe
     */
    public function is_member()
    {
        $j = $this->members()->find(Auth::id());
        return $this->admin_id == Auth::id() || (!empty($j) && $j->pivot->etat == 'accepté');
    }

    /**
     * Is a user not a member in the groupe
     */
    public function is_outsider($user_id)
    {
        if ($this->admin_id == $user_id)
            return false;
        $j = $this->members()->find($user_id);
        return (empty($j) || $j->pivot->etat == 'attendre');
    }

    /**
     * Is the group privite on the auth user
     */
    public function is_private()
    {
        return $this->etat == 'private' && Auth::user()->etat != 'admin' && !$this->is_member();
    }

    /**
     * Is the group status is privite
     */
    public function status_private()
    {
        return $this->etat == 'private';
    }

    /**
     * Is the group public
     */
    public function is_public()
    {
        return $this->etat == 'public';
    }

    /**
     * Get the icon of the group
     * 
     */
    public function get_icon()
    {
        return '\img\group-' . $this->icon . '.png';
    }
}
