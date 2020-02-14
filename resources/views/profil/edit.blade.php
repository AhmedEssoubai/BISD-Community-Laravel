@extends('layouts.profil-edit')

@section('form')
<form method="POST" enctype="multipart/form-data" action="/profils/{{ $user->id }}">
    @csrf
    @method('PATCH')

    <h2 class="pb-3">
        Profil
    </h2>
    <div class="form-groupe my-3">
        <label class="control-label" for="nom">Nom : </label>
        <input id="nom" name="nom" type="text" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') ?? $user->nom }}" placeholder="Votre nom" required autocomplete="nom" autofocus />
        @error('nom')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-groupe my-3">
        <label class="control-label" for="prenom">Prénom : </label>
        <input id="prenom" name="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" value="{{ old('prenom') ?? $user->prenom }}" placeholder="Votre prénom" required autocomplete="prenom" />
        @error('prenom')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-groupe my-3">
        <label class="control-label" for="email">E-mail : </label>
        <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? $user->email }}" placeholder="Votre email" required autocomplete="email" />
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group my-3">
        <label for="niveau">Niveau :</label>
        <select id="niveau" name="niveau" class="form-control"> 
            <option @if((old('niveau') ?? $user->niveau) == 'MBISD1') selected @endif value="MBISD1">MBISD1</option>
            <option @if((old('niveau') ?? $user->niveau) == 'MBISD2') selected @endif value="MBISD2">MBISD2</option>
            <option @if((old('niveau') ?? $user->niveau) == 'MSCEE1') selected @endif value="MSCEE1">MSCEE1</option>
            <option @if((old('niveau') ?? $user->niveau) == 'MSCEE2') selected @endif value="MSCEE2">MSCEE2</option>
            <option @if((old('niveau') ?? $user->niveau) == 'MCSC1') selected @endif value="MCSC1">MCSC1</option>
            <option @if((old('niveau') ?? $user->niveau) == 'MCSC2') selected @endif value="MCSC2">MCSC2</option>
            <option @if((old('niveau') ?? $user->niveau) == 'MPSI1') selected @endif value="MPSI1">MPSI1</option>
            <option @if((old('niveau') ?? $user->niveau) == 'MPSI2') selected @endif value="MPSI2">MPSI2</option>
            <option @if((old('niveau') ?? $user->niveau) == 'ISIL') selected @endif value="ISIL">ISIL</option>
        </select>
    </div>
    <div class="form-group my-3">
        <label>Image :</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input @error('image') is-invalid @enderror" value="{{ old('image') }}" id="image" name="image">
            <label class="custom-file-label" for="image">Choisir image</label>
            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-groupe mt-5">
        <button type="submit" class="btn btn-primary btn-lg form-control">Sauvegarder les modifications</button>
    </div>
</form>
@endsection