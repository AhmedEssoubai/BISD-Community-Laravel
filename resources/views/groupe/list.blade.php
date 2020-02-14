@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light">
    <div class="container">
        <div class="row mt-2 mb-3 border-bottom pb-3 d-flex justify-content-between">
            <h2 class="text-muted">Groupes que vous créez ({{ $my_groupes->count() }})</h2>
            <h5 class="align-self-end"><a class="btn btn-primary" href="{{ route('groupes.create') }}">Nouveau groupe  <i class="ml-2 fas fa-plus"></i></a></h5>
        </div>
        <div class="row mb-5">
            @foreach ($my_groupes as $groupe)
            <div class="col-sm-6 col-md-4 col-lg-3 my-3">
                <div class="card shadow-sm">
                    <div class="card-img-top img_box"><a href="/groupes/{{ $groupe->id }}"><img class="img_self" src="{{ $groupe->image }}" alt="groupe image"></a></div>
                    <div class="card-body d-flex">
                        <div class="flex-grow-1">
                            <h5 class="card-title">
                                <a class="_link" href="/groupes/{{ $groupe->id }}">{{ $groupe->label }}</a>
                                @if ($groupe->status_private())
                                <span title="Privé" class="ml-2 text-muted align-self-center" style="font-size: 0.7em"><i class="fas fa-lock"></i></span>
                                @endif
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $groupe->members_count() }} members</h6>
                        </div>
                        <div class="d-flex pr-2 dropdown align-self-center">
                            <span class="icon-mute" id="groupe_{{ $groupe->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="groupe_{{ $groupe->id }}_options">
                                <a class="dropdown-item" href="{{ route('groupes.pending', ['groupe' => $groupe->id]) }}">Administrateur</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if ($my_groupes->count() == 0)
                <div class="col text-muted text-center py-2 px-2 my-3">
                    <h2 class="my-3" style="font-size: 3em"><i class="fas fa-box-open"></i></h2>
                    <h4 class="my-3">Aucun groupe à afficher</h4>
                    <h5 class="my-3">Cliquez sur "<i class="fas fa-plus"></i>" pour créer votre premier groupe</h5>
                </div>
            @endif
        </div>
        <div class="row mt-2 mb-3 border-bottom pb-3">
            <h2 class="text-muted">Groupes que vous apparteniez à ({{ $joined_groupes->count() }})</h2>
        </div>
        <div class="row mb-5">
            @foreach ($joined_groupes as $groupe)
            <div class="col-sm-6 col-md-4 col-lg-3 my-3">
                <div class="card shadow-sm">
                    <div class="card-img-top img_box"><a href="/groupes/{{ $groupe->id }}"><img class="img_self" src="{{ $groupe->image }}" alt="groupe image"></a></div>
                    <div class="card-body d-flex">
                        <div class="flex-grow-1">
                            <h5 class="card-title">
                                <a class="_link" href="/groupes/{{ $groupe->id }}">{{ $groupe->label }}</a>
                                @if ($groupe->status_private())
                                <span title="Privé" class="ml-2 text-muted align-self-center" style="font-size: 0.7em"><i class="fas fa-lock"></i></span>
                                @endif
                            </h5>
                            @if (!$groupe->is_private())
                                <h6 class="card-subtitle mb-2 text-muted">{{ $groupe->members_count() }} members</h6>
                            @else
                                <h6 class="card-subtitle mb-2 text-info">Liste en attente</h6>
                            @endif
                        </div>
                        <div class="d-flex pr-2 dropdown align-self-center">
                            <span class="icon-mute" id="groupe_{{ $groupe->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="groupe_{{ $groupe->id }}_options">
                                <a class="dropdown-item" href="javascript:join('{{ route('groupes.leave', ['groupe' => $groupe->id, 'user' => Auth::id()]) }}')">Quitter</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if ($joined_groupes->count() == 0)
                <div class="col text-muted text-center py-2 px-2 my-3">
                    <h2 class="my-3" style="font-size: 3em"><i class="far fa-frown-open"></i></h2>
                    <h4 class="my-3">Pourquoi es-tu si seul</h4>
                    <h5 class="my-3">Rejoignez quelqu'un</h5>
                </div>
            @endif
        </div>
    </div>
    <script type="text/javascript" src="{{ asset("js/join-script.js") }}"></script>
</section>
@endsection