@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light" id="profil">
    <div class="container">
        <div class="row bg-white shadow-sm">
            <div class="col p-0 border">
                <div id="cover"></div>
                <div class="p-4">
                    <img id="profil-avatar" src="{{ asset('img/default.png') }}" class="img-fluid rounded-circle">
                    <h2 id="name" class="my-3">
                        {{ $user->prenom }} {{ $user->nom }}
                    </h2>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="container px-0">
                <div class="row">
                    <div class="col-md-8">
                        <!-- POSTS -->
                        @foreach($user->posts as $post)
                        <div id="post1" class="bg-white rounded my-5 shadow-sm border">
                            <div class="p-3 d-flex align-items-center">
                                <a href="#"><img src="{{ asset('img/default.png') }}" alt="profile image" class="avatare img-fluid rounded-circle" /></a>
                                <div class="ml-3 d-flex flex-column">
                                    <a class="_link" href="#">{{ $post->compte->prenom }} {{ $post->compte->nom }}</a>
                                    <a class="_sec_link" href="#"><span>{{ $post->groupe->label }}</span></a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="/storage/{{ $post->image }}" class="card-img-top" alt="post image">
                                <div class="card-body">
                                    <div class="pb-3">
                                        <a class="icon mr-3" href="#">
                                            <i class="fa fa-heart-o text-grey" aria-hidden="true"></i>
                                        </a>
                                        <a class="icon" href="#">
                                            <i class="fa fa-bookmark-o text-grey" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <h5 class="card-title">{{ $post->titre }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">0 j'aime</h6>
                                    <p class="card-text">{{ $post->content }}</p>
                                    <p class="card-text"><small class="text-muted">{{ $post->date_publication }}</small></p>
                                </div>
                                <div class="card-footer">
                                    <a href="\post\{{ $post->id }}"><small class="text-muted">0 commentaires</small></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!--Groupes list-->
                    <div class="col-md-4">
                        <div class="bg-white py-3 shadow-sm border">
                            <h5 class="mx-3">Votre groupes</h5>
                            <div class="list-group py-3">
                                <a href="#" class="list-group-item d-flex align-items-center">
                                    <img class="img-fluid groupe-icon mr-3" src="{{ asset('img/group-0.png') }}" />
                                    BISD
                                </a>
                                <a href=" #" class="list-group-item d-flex align-items-center">
                                    <img class="img-fluid groupe-icon mr-3" src="{{ asset('img/group-3.png') }}" />
                                    ISIL
                                </a>
                            </div>
                            <div class="text-center">
                                <a href="groupes-appartiens.html" class="_link px-3">Afficher tous</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection