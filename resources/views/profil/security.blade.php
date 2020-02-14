@extends('layouts.profil-edit')

@section('form')
<form method="POST" action="/profils/securite/{{ $id }}">
    @csrf
    @method('PATCH')

    <h2 class="pb-3">
        Changer le mot de passe
    </h2>
    <div class="form-group  my-3">
        <label for="current-password">Ancien mot de passe :</label>
        <input type="password" name="current-password" class="form-control @error('current-password') is-invalid @enderror" id="current-password" placeholder="Entrez le mot de passe actuel" required autocomplete="current-password" />
        @error('current-password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group  my-3">
        <label for="password">Nouveau mot de passe :</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Entrez un nouveau mot de passe" required autocomplete="password" />
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group  my-3">
        <label for="password_confirmation">Confirmer le nouveau mot de passe :</label>
        <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirmer le nouveau mot de passe" required autocomplete="password_confirmation" />
    </div>
    <div class="form-groupe mt-5">
        <button type="submit" class="btn btn-primary btn-lg form-control">Mettre à jour le mot de passe</button>
    </div>
</form>
@endsection