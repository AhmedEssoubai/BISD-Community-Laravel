@extends('layouts.groupe')

@section('content-2')
<div class="container px-0">
    @if (!$groupe->can_join() || Auth::user()->is_admin())
    <div class="row py-3 mt-4 border-bottom border-top">
        <div class="col nav nav-fill">
            <a class="nav-item nav-link" href="{{ route('groupes.pending', ['groupe' => $groupe->id]) }}">Liste d'attente</a>
            <a class="nav-item nav-link" href="{{ route('groupes.members', ['groupe' => $groupe->id]) }}">Members</a>
            @if (!$groupe->can_join())
            <a class="nav-item nav-link" href="{{ route('groupes.edit', ['groupe' => $groupe->id]) }}">Paramètres</a>
            @endif
        </div>
    </div>
    @endif
    <div class="row my-5">
        @yield('content-3')
    </div>
</div>
@endsection