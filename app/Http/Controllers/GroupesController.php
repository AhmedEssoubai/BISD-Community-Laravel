<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Groupe;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $this->middleware('pending');
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
            'icon' => ['required', 'string', 'max:255'],
            'etat' => ['required', 'string', 'max:255']
        ]);
        $admin = Auth::id();
        $g = Groupe::create([
            'label' => $data['label'],
            'icon' => $data['icon'],
            'etat' => $data['etat'],
            'admin_id' => $admin,
            'image' => '/img/groupe-cover.jpg',
            'description' => $data['label']
        ]);
        return redirect()->route('groupes.show', ['groupe' => $g->id]);
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

    /**
     * Show a edit groupe form
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Groupe $groupe)
    {
        $this->authorize('update', $groupe);

        return view('groupe.edit', compact('groupe'));
    }

    /**
     * Delete a group
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function destroy(Groupe $groupe)
    {
        $this->authorize('delete', $groupe);

        $groupe->delete();
        
        return redirect()->route('admin.groupes.all');
    }

    /**
     * Join a groupe
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function join(Groupe $groupe)
    {
        $this->authorize('join', $groupe);

        $msg = 'Already exists';
        if (empty($groupe->members()->find(Auth::id())))
        {
            if ($groupe->is_public())
                $status = ['etat' => 'accepté'];
            $groupe->members()->attach(Auth::id(), $status ?? []);
            $msg = 'Joined';
        }
        return response()->json(['message' => $msg], 200);
        //return response()->back();
    }

    /**
     * Kick a user from a groupe or leave a groupe
     *
     */
    public function leave(Groupe $groupe, \App\User $user)
    {
        $this->authorize('leave', $groupe);

        $msg = 'Not exists';
        if (!empty($groupe->members()->find($user->id)))
        {
            $groupe->members()->detach($user->id);
            $msg = 'Not joined';
        }
        return response()->json(['message' => $msg], 200);
        //return response()->back();
    }

    /**
     * Accept a user
     *
     */
    public function accept_member(Groupe $groupe, \App\User $user)
    {
        $this->authorize('leave', $groupe);

        $msg = 'Not exists';
        if (!empty($groupe->members()->find($user->id)))
        {
            $groupe->members()->updateExistingPivot($user->id, ['etat' => 'accepté']);
            $msg = 'Accepted';
        }
        return response()->json(['message' => $msg], 200);
        //return response()->back();
    }

    /**
     * Show a the list of groupes
     *
     */
    public function list()
    {
        return view('groupe.list', ['my_groupes' => Auth::user()->founding_groupes()->get(), 'joined_groupes' => Auth::user()->joined_groupes()->get()]);
    }

    /**
     * Show pending list of a group to it's admin
     *
     */
    public function admin_pending(Groupe $groupe)
    {
        //$this->authorize('d', $groupe);

        return view('groupe.pending', ['groupe' => $groupe]);
    }

    /**
     * Show the members of a group
     *
     */
    public function members(Groupe $groupe)
    {
        return view('groupe.members', ['groupe' => $groupe]);
    }

    /**
     * Update the data of a groupe
     * 
     */
    public function update(Groupe $groupe)
    {
        $this->authorize('update', $groupe);

        $data = request()->validate([
            'label' => ['required', 'string', 'max:255'],
            'icon' => ['required', 'string', 'max:255'],
            'etat' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['image']
        ]);

        if (!empty($data['image']))
        {
            //Storage::delete($groupe->image);
            $image = ['image' => '/storage/' . ($data['image']->store('groupes', 'public'))];
        }

        $groupe->update(array_merge($data, $image ?? []));
        
        return redirect()->back();
    }
}
