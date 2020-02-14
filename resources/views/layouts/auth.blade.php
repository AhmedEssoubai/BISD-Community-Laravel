@extends('layouts.app')

@section('content')
<div>
    <section id="login">
        <div class="container">
            <div class="row">
                <div id="forme" class="col-sm-6 offset-sm-6 p-5 my-3">
                    @yield('form')
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
