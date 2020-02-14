@extends('layouts.auth')

@section('form')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <h2 class="mb-5 pt-5 pb-3">
        Réinitialiser le mot de passe
    </h2>

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

    <div class="form-group mt-5">
        <button type="submit" class="btn btn-primary btn-lg form-control">
            Envoyer
        </button>
    </div>
</form>
@endsection