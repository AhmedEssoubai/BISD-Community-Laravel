@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light">
    <div class="container mb-5" style="min-height: 54vh;">
        <div class="row mt-2 mb-3 border-bottom pb-3">
            <h2 class="text-muted">Résultat de "{{ $value }}"</h2>
        </div>
        @foreach ($groupes as $groupe)
        <div class="row my-3 bg-white shadow-sm">
            <div class="col-sm-2 px-0">
                <div class="img_box2"><a href="/groupes/{{ $groupe->id }}"><img class="img_self" src="{{ $groupe->image }}" alt="groupe image"></a></div>
                {{--<a href="/groupes/{{ $groupe->id }}"><img class="img-fluid" src="{{ $groupe->get_icon() }}" alt="groupe image"></a>--}}
            </div>
            <div class="col-sm-10 p-4 d-flex align-self-center">
                <div class="flex-grow-1">
                    <h5 class="card-title"><a class="_link" href="/groupes/{{ $groupe->id }}">{{ $groupe->label }}</a></h5>
                    @if (!$groupe->is_private())
                        <h6 class="card-subtitle mb-2 text-muted">{{ $groupe->members_count() }} members</h6>
                    @else
                        @if ($groupe->is_pending())
                        <h6 class="card-subtitle mb-2 text-info">Liste en attente</h6>
                        @endif
                    @endif
                </div>
                @if ($groupe->can_join())
                    <div class="pr-2">
                        @if ($groupe->is_pending() || $groupe->is_member())
                            <a id="btn_g{{ $groupe->id }}" class="px-4 py-2 rounded-pill btn btn-os" href="javascript:join({{ $groupe->id }}, {{ Auth::id() }})">Quitter</a>
                        @else
                            <a id="btn_g{{ $groupe->id }}" class="px-4 py-2 rounded-pill btn btn-primary text-white" href="javascript:join({{ $groupe->id }}, {{ Auth::id() }})">Joindre</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        @endforeach
        @if ($groupes->count() == 0)
            <div class="row my-3">
                <div class="col text-muted text-center py-2 px-2">
                    <h2 class="my-3" style="font-size: 3em"><i class="fas fa-box-open"></i></h2>
                    <h4 class="my-3">Aucun groupe à afficher</h4>
                </div>
            </div>
        @endif
    </div>
    <script type="text/javascript" src="{{ asset("js/join-search-script.js") }}"></script>
</section>
@endsection