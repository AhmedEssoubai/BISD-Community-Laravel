@extends('layouts.profil-edit')

@section('form')
<div>
    <h2 class="pb-3">
        Options de compte
    </h2>
    <p class="lead my-3 text-danger">
        Prendre une profonde respiration, réfléchissez bien.<br>
        Une fois que vous avez supprimé votre compte, vous ne pouvez plus revenir en arrière. Soyez certain.
    </p>
    <div class="mt-5">
        <a class="btn btn-od" data-toggle="modal" data-target="#delete_user">Supprimer le compte</a>
    </div>
    <div class="modal fade" id="delete_user" tabindex="-1" role="dialog" aria-labelledby="du-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="du-modalLabel">Supprimer le compte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    êtes-vous sûr de cela
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="d-link" class="btn btn-danger" href="/users/d/{{ $id }}">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection