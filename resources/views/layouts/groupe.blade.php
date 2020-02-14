@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light" id="groupe">
    <div class="container">
        <div class="row bg-white shadow-sm">
            <div class="col p-0 border">
            <div id="cover" style="background-image: url('{{ $groupe->image }}')"></div>
                <div class="container p-4">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h2 class="mb-3">
                                <a href="{{ route('groupes.show', ['groupe' => $groupe->id]) }}" class="_link">
                                    {{ $groupe->label }}
                                </a>
                            </h2>
                            @if (!$groupe->is_private())
                            <p class="lead mt-2">
                                Members : {{ $groupe->members_count() }}
                            </p>
                            @endif
                            @if (!$groupe->can_join() || Auth::user()->is_admin())
                            <a href="{{ route('groupes.pending', ['groupe' => $groupe->id]) }}" class="_link">
                                Admin
                            </a>
                            @endif
                        </div>
                        @if ($groupe->can_join())
                            <div class="col-2">
                                @if ($groupe->is_pending() || $groupe->is_member())
                                    <a class="px-5 py-2 rounded-pill btn btn-os" href="javascript:join('{{ route('groupes.leave', ['groupe' => $groupe->id, 'user' => Auth::id()]) }}')">Quitter</a>
                                @else
                                    <a class="px-5 py-2 rounded-pill btn btn-primary text-white" href="javascript:join('{{ route('groupes.join', ['groupe' => $groupe->id]) }}')">Joindre</a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            @yield('content-2')
        </div>
    </div>
    @if ($groupe->can_join())
        <script type="text/javascript" src="{{ asset("js/join-script.js") }}"></script>
    @endif
</section>
@endsection