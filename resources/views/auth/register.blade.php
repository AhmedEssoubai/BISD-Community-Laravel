@extends('layouts.app')

@section('content')
<div>
    <section id="login">
        <div class="container">
            <div class="row">
                <div id="forme" class="col-md-6 offset-sm-6 p-5 my-3">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <h2 class="mb-5 pt-5 pb-3">
                            S'inscrire
                        </h2>
                        <div class="form-groupe my-3">
                            <label class="control-label" for="nom">Nom : </label>
                            <input id="nom" name="nom" type="text" class="form-control @error('nom') is-invalid @enderror" placeholder="Entrez votre nom" required autocomplete="nom" autofocus/>
                        </div>
                        <div class="form-groupe my-3">
                            <label class="control-label" for="prenom">Prénom : </label>
                            <input id="prenom" name="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" placeholder="Entrez votre prénom" required autocomplete="prenom"/>
                        </div>
                        <div class="form-groupe my-3">
                            <label class="control-label" for="email">E-mail : </label>
                            <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Entrez vote email" required autocomplete="email"/>
                        </div>
                        <div class="form-group  my-3">
                            <label for="exampleInputPassword1">Mot de passe : </label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Tapez votre mot de passe" required autocomplete="password"/>
                        </div>
                        <div class="form-group  my-3">
                            <label for="password">Veuillez confimer votre mot de passe : </label>
                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confimer votre mot de passe" required autocomplete="password_confirmation"/>
                        </div>
                        <div class="form-group my-3">
                            <label for="niveau">Niveau</label>
                            <select id="niveau" name="niveau" class="form-control">
                                <option selected value="BISD01">BISD01</option>
                                <option value="BISD02">BISD02</option>
                            </select>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choisir image</label>
                        </div>
                        <div class="form-groupe mt-5">
                            <button type="submit" class="btn btn-primary btn-lg form-control">S'inscrire</button>
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
                        Si vous possédez déjà un compte. <a href="{{ route('login') }}" class="_link">Se connecter</a>
                    </h5>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection