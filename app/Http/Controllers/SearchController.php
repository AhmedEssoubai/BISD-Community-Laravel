<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (empty($request['value']))
            return redirect()->route('home');
        $value = $request['value'];
        return view('search.show', ['groupes' => \App\Groupe::where('label', 'like', '%' . $value . '%')->orWhere('description', 'like', '%' . $value . '%')->get(), 'value' => $value]);
    }

    /**
     * Show list of groupes the label given match there label or description
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($value)
    {
        //return view('search.show', ['groupes' => \App\Groupe::where('label', $value), 'value' => $value]);
    }
}
