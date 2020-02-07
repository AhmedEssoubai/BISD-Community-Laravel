@extends('layouts.app')

@section('content')
<div>
    <section id="login">
        <div class="container">
            <div class="row">
                <div id="forme" class="col-sm-6 offset-sm-6 p-5 my-3">
                    <form class="pt-5" method="POST" action="{{ route('login') }}">
                        @csrf
                        <h2 class="mb-5 pt-5 pb-3">
                            Se connecter
                        </h2>

                        <div class="form-group my-4">
                            <label for="email" class="control-label">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Entrer votre email" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group my-4">
                            <label for="password" class="control-label">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Entrer votre mot de passe" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group my-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Souviens-toi de moi
                                </label>
                            </div>
                        </div>

                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary btn-lg form-control mb-3">
                            Se connecter
                            </button>

                            @if (Route::has('password.request'))
                                <!--<a class="_link lead" href="{{ route('password.request') }}">
                                    {{ __('Mot de passe oublié?') }}
                                </a>-->
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h5 class="text-secondary">
                        Vous n'avez pas de compte ? veuillez s'inscrire ici : <a href="{{ route('register') }}" class="_link">S'inscrire</a>
                    </h5>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
