@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light">
    <div class="container">
        <div class="row bg-white shadow">
            <div class="col-md-4 p-5 my-3 border-right">
                <h4 class="mb-2 pb-3">
                    Paramètres personnels
                </h4>
                <ul class="list-group border-0">
                    <li class="list-group-item border-0"><a 
                        @if ($page == 0)
                        class="active"
                        @endif
                        href="/parametres/profil">Profil</a></li>
                    <li class="list-group-item border-0"><a 
                        @if ($page == 1)
                        class="active"
                        @endif
                        href="/parametres/securite">Sécurité</a></li>
                    <li class="list-group-item border-0"><a 
                        @if ($page == 2)
                        class="active"
                        @endif
                        href="/parametres/compte">Compte</a></li>
                </ul>
            </div>
            <div class="col-md-8 p-5 my-3">
                @yield('form')
            </div>
        </div>
    </div>
</section>
@endsection