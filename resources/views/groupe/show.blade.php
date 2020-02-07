@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light" id="groupe">
    <div class="container">
        <div class="row bg-white shadow-sm">
            <div class="col p-0 border">
                <div id="cover"></div>
                <div class="container p-4">
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <h2 class="mb-3">
                                {{ $groupe->label }}
                            </h2>
                            <p class="lead mt-2">
                                Members : 1
                            </p>
                            <a href="admingroupe.html" class="_link">
                                Admin
                            </a>
                        </div>
                        <!--<div class="col-2">
                            <a class="px-5 py-2 rounded-pill btn btn-primary text-white m-auto">Joindre</a>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="container px-0">
                <div class="row">
                    <div class="col-md-8">
                        <div id="newPost" class="bg-white p-3 shadow-sm border">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('posts') }}">
                                @csrf
                                <h3 class="mb-3">
                                    Nouveau post
                                </h3>
                                <input type="text" name="titre" class="form-control my-2" placeholder="Titre du post" require />
                                <textarea class="form-control my-2" name="content" rows="4" placeholder="Partager vos idées" require></textarea>
                                <div class="custom-file my-2">
                                    <input type="file" name="image" class="custom-file-input" id="postImage">
                                    <label class="custom-file-label" for="postImage">Choisir image</label>
                                </div>
                                <input type="text" name="tags" class="form-control my-2" placeholder="Tags ex: #c #php..." />
                                <input type="hidden" name="groupe_id" value="{{ $groupe->id }}" />
                                <button type="submit" class="btn btn-primary form-control my-2">Publier</button>
                            </form>
                        </div>
                        <!-- POST 1 -->
                        @foreach($groupe->posts as $post)
                        <div id="post1" class="bg-white rounded my-5 shadow-sm border">
                            <div class="p-3 d-flex align-items-center">
                                <a href="#"><img src="{{ asset('img/default.png') }}" alt="profile image" class="avatare img-fluid rounded-circle" /></a>
                                <div class="ml-3 d-flex flex-column">
                                    <a class="_link" href="#">{{ $post->compte->prenom }} {{ $post->compte->nom }}</a>
                                    <a class="_sec_link" href="#"><span>{{ $groupe->label }}</span></a>
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
                                    <h6 class="card-subtitle mb-2 text-muted">
                                        <span>{{ $post->favorited_users->count() }}</span> j'aime
                                    </h6>
                                    <p class="card-text">{{ $post->content }}</p>
                                    <p class="card-text"><small class="text-muted">{{ \Carbon\Carbon::parse($post->date_publication)->format('d M Y h:i')}}</small></p>
                                </div>
                                <div class="card-footer">
                                    <a href="\post\{{ $post->id }}"><small class="text-muted">{{ $post->comments->count() }} commentaires</small></a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!-- POST 2 
                        <div id="post2" class="bg-white rounded my-5 shadow-sm border">
                            <div class="p-3 d-flex align-items-center">
                                <a href="#"><img src="{{ asset('img/default.png') }}" alt="profile image" class="avatare img-fluid rounded-circle" /></a>
                                <div class="ml-3 d-flex flex-column">
                                    <a class="_link" href="#">Ahmed Essoubai</a>
                                    <a class="_sec_link" href="#"><span>BISD</span></a>
                                </div>
                            </div>
                            <div class="card">
                                <img src="{{ asset('img/post.jpeg') }}" class="card-img-top" alt="post image">
                                <div class="card-body">
                                    <div class="pb-3">
                                        <a class="icon mr-3" href="#">
                                            <i class="fa fa-heart-o text-grey" aria-hidden="true"></i>
                                        </a>
                                        <a class="icon" href="#">
                                            <i class="fa fa-bookmark text-grey active" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <h5 class="card-title">Soluta ipsum dolor sit, amet consectetur adipisicing elit.</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">3 j'aime</h6>
                                    <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Repellat incidunt corrupti itaque ea architecto blanditiis quasi consequuntur deserunt eveniet quisquam dolorem fuga expedita libero dolor veniam, debitis eos recusandae odio!</p>
                                    <p class="card-text"><small class="text-muted">01 SEPTEMBRE 2019</small></p>
                                </div>
                                <div class="card-footer">
                                    <a href="#"><small class="text-muted">2 commentaires</small></a>
                                </div>
                            </div>
                        </div>-->
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