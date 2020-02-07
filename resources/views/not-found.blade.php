@extends('layouts.app')

@section('content')
<div class="container text-center">
    <div class="row my-3">
        <div class="col my-5">
            <div class="my-5 py-5">
                <h1>
                    Oops!</h1>
                <h2>
                    404 Pas trouvé</h2>
                <div class="error-details">
                    Désolé, une erreur s'est produite, page demandée introuvable!
                </div>
                <div class="error-actions text-white my-3">
                    <a href="/welcome" class="btn btn-primary btn-lg">
                        Accueil </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection