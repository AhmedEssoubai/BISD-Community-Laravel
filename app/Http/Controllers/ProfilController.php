<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
    }

    /**
     * Show a groupe
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($user)
    {
        return view('profil.show', ['user' => User::findOrFail($user)]);
    }
}
