<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
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
     * Show a profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show(User $user)
    {
        //dd($user->posts()->get());
        return view('profil.show', ['user' => $user]);
    }

    /**
     * Show the edit profile form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit()
    {
        return view('profil.edit', ['user' => auth()->user(), 'page' => 0]);
    }

    /**
     * Show the edit password form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function security()
    {
        return view('profil.security', ['id' => auth()->id(), 'page' => 1]);
    }

    /**
     * Show the account options
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function account()
    {
        return view('profil.account', ['id' => auth()->id(), 'page' => 2]);
    }

    /**
     * Update a profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(User $user)
    {
        $this->authorize('update', $user);

        $data = request()->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'niveau' => 'required',
            'image' => ['image']
        ]);

        if (!empty($data['image']))
        {
            if (auth()->user()->image != '/img/default.png')
                Storage::delete(auth()->user()->image);
            $image = ['image' => '/storage/' . $data['image']->store('avatars', 'public')];
        }

        auth()->user()->update(array_merge($data, $image ?? []));
        
        return redirect()->route('profils.show', ['user' => $user]);
    }

    /**
     * Update password
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update_security(User $user)
    {
        $this->authorize('update', $user);

        $data = request()->validate([
            'current-password' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        if (!Hash::check($data['current-password'], auth()->user()->password))
            return back()->withErrors('Mot de passe incorrect');

        if (Hash::check($data['password'], auth()->user()->password))
            return back()->withErrors('Nouveau mot de passe invalide');

        auth()->user()->update(['password' => Hash::make($data['password'])]);
    
        return redirect()->route('profils.show', ['user' => $user]);
    }
}
