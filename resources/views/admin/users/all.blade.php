@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light">
    <div class="container" style="min-height: 60vh;">
        <div class="row">
            <div class="col d-flex">
                <h2>Liste des utilisateurs ({{ $users->count() }}) - </h2>
                <h4 class="align-self-center mx-3 mt-1"><a class="_link" href="{{ route('admin.users.pending') }}">List d'attente</a></h4>
            </div>
        </div>
        <div class="row mt-3">
            @foreach($users as $user)
            <div class="col-md-6 my-3">
                <div class="d-flex bg-white shadow-sm p-4">
                    <div class="pr-3">
                        <a href="/profils/{{ $user->id }}"><img src="{{ $user->image }}" class="img-fluid rounded-circle" width="78px"/></a>
                    </div>
                    <div class="flex-grow-1 d-flex flex-column">
                        <h4><a href="/profils/{{ $user->id }}" class="_link">{{ $user->prenom }} {{ $user->nom }}</a> <span class="badge badge-primary">{{ $user->niveau }}</span></h4>
                        <p class="text-muted">{{ $user->email }}</p>
                    </div>
                    <div class="align-self-center p-3">
                        @if ($user->is_admin())
                            <div class="mx-3 icon-mute" title="Admin"><span><i class="fas fa-crown"></i></span></div>
                        @else
                            <div class="d-flex pr-3 align-items-center dropdown">
                                <span class="icon-mute" id="user_{{ $user->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></span>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="user_{{ $user->id }}_options">
                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_user" data-id="{{ $user->id }}">Supprimer</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @if ($users->count() == 0)
            <h3 class="col my-4 text-muted text-center"><i class="far fa-frown"></i> La communauté est vide</h3>
            @endif
        </div>
        <div class="modal fade" id="delete_user" tabindex="-1" role="dialog" aria-labelledby="du-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="du-modalLabel">Supprimer l'utilisateur</h5>
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
            $('#delete_user').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var modal = $(this);
                modal.find('#d-link').attr('href', '/users/d/' + id);
            });
        });
    </script>
</section>
@endsection