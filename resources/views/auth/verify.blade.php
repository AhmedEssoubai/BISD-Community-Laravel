@extends('layouts.auth')

@section('form')
<div>
    <h2 class="mb-5 pt-5 pb-3">
        Vérifiez votre adresse e-mail
    </h2>

    <div>
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
            </div>
        @endif

        Avant de continuer, veuillez vérifier votre e-mail pour un lien de vérification.
        Si vous n'avez pas reçu l'e-mail,
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Cliquez ici pour en demander un autre</button>.
        </form>
    </div>
</div>
@endsection
