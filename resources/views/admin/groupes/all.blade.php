@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light" style="min-height: 70vh">
    <div class="container">
        <div class="row">
            <div class="col d-flex">
                <h2>Liste des groupes ({{ $groupes->count() }})</h2>
            </div>
        </div>
        <div class="row mt-3">
            @foreach ($groupes as $groupe)
            <div class="col-sm-6 col-md-4 col-lg-3 my-3">
                <div class="card shadow-sm">
                    <div class="card-img-top img_box"><a href="/groupes/{{ $groupe->id }}"><img class="img_self" src="{{ $groupe->image }}" alt="groupe image"></a></div>
                    <div class="card-body d-flex">
                        <div class="flex-grow-1">
                            <h5 class="card-title d-flex">
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
                                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_groupe" data-id="{{ $groupe->id }}">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if ($groupes->count() == 0)
                <div class="col text-muted text-center py-2 px-2">
                    <h2 class="my-3" style="font-size: 3em"><i class="fas fa-box-open"></i></h2>
                    <h4 class="my-3">Aucun groupe à afficher</h4>
                    <h5 class="my-3">Cliquez <a href="{{ route('groupes.create') }}" class="_link">ici</a> pour créer une groupe</h5>
                </div>
            @endif
        </div>
        <div class="modal fade" id="delete_groupe" tabindex="-1" role="dialog" aria-labelledby="dg-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dg-modalLabel">Supprimer le groupe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    êtes-vous sûr de cela
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="d-link" class="btn btn-danger">Supprimer</a>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#delete_groupe').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                modal.find('#d-link').attr('href', '/groupes/d/' + id);
            });
        });
    </script>
</section>
@endsection