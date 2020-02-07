<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Groupe;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class GroupesController extends Controller
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
     * Create a new group instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Groupe
     */
    public function store()
    {
        $data = request()->validate([
            'label' => ['required', 'string', 'max:255'],
            'icon' => '',
            'etat' => ''
        ]);
        $admin = Auth::id();
        Groupe::create([
            'label' => $data['label'],
            'icon' => 'group-' . $data['icon'] . '.png',
            'etat' => $data['etat'],
            'admin_id' => $admin
        ]);
        return redirect()->route('groupe.show', ['groupe' => 1]);
    }

    /**
     * Show a groupe
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($groupe)
    {
        return view('groupe.show', ['groupe' => Groupe::findOrFail($groupe)]);
    }

    /**
     * Show a add groupe form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('groupe.add');
    }
}
