<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        //$this->middleware('admin');
    }

    /**
     * Accept a user
     *
     * @param  array  $data
     * @return \App\Groupe
     */
    public function accept_user(User $user)
    {
        $user->update(['etat' => 'membre']);
        
        $user->joined_groupes()->attach(1, ['etat' => 'accepté']);
        
        return \App::make('redirect')->back();
    }

    /**
     * Delete a user
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy_user(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();
        
        return \App::make('redirect')->back();
    }

    /**
     * Show the users in pending list
     */
    public function pending_users()
    {
        return view('admin.users.pending', ['users' => User::where('etat', 'en attente')->orderBy('id', 'DESC')->get()]);
    }

    /**
     * Show the users list
     */
    public function all_users()
    {
        return view('admin.users.all', ['users' => User::where('etat', '<>', 'en attente')->orderBy('id', 'DESC')->get()]);
    }

    /**
     * Show all the groupes
     *
     */
    public function all_groupes()
    {
        return view('admin.groupes.all', ['groupes' => \App\Groupe::get()]);
    }
}
