@extends('layouts.auth')

@section('form')
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <h2 class="mb-5 pt-5 pb-3">
        Réinitialiser le mot de passe
    </h2>

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="form-group my-3">
        <label for="email">Address E-Mail</label>

        <div>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group my-3">
        <label for="password">Mot de passe</label>

        <div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group my-3">
        <label for="password-confirm">Confimer votre mot de passe</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group mt-5">
        <button type="submit" class="btn btn-primary btn-lg">
            Réinitialiser le mot de passe
        </button>
    </div>
</form>
@endsection
