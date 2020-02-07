@extends('layouts.app')

@section('content')
<div>
    <section class="py-5 text-left bg-light" id="groupe">
        <div class="container">
            <div class="row bg-white shadow border">
                <div class="col p-0">
                    <div class="p-3 d-flex align-items-center">
                        <a href="#"><img src="{{ asset('img/default.png') }}" alt="profile image" class="avatare img-fluid rounded-circle" /></a>
                        <div class="ml-3 d-flex flex-column">
                            <a class="_link" href="#">{{ $post->compte->prenom }} {{ $post->compte->nom }}</a>
                            <a class="_sec_link" href="groupe.html"><span>{{ $post->groupe->label }}</span></a>
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
                            <small class="text-muted"><span id="count">0</span> commentaires</small>
                        </div>
                    </div>
                    <div class="p-4">
                        <ul id="comments" class="list-unstyled">
                            @foreach($post->comments as $comment)
                            <li class="media mb-3">
                                <img src="{{ asset('img/default.png') }}" class="mr-3 com-avatare rounded-circle" alt="avatar">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-3"><a href="#" class="_link">{{ $comment->user->prenom }} {{ $comment->user->nom }}</h5></a>
                                    <p>{{ $comment->content }}</p>
                                    <small class="text-muted">{{ $comment->date_publication }}</small>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <div class="border-top mt-4 pt-4">
                            <form>
                                <!--<input value="{{ $post->id }}" name="postId" hidden />-->
                                <textarea id="content" class="form-control" name="content" rows="3" placeholder="Ajouter un commentaire..."></textarea>
                                <!--<input type="submit" class="my-3 form-control" value="Publier" />-->
                                <button type="button" class="my-3 form-control" onclick="addComment()">Publier</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function addComment() {
        document.getElementById("count").innerHTML = document.getElementById("count").innerHTML + 1;
        document.getElementById("comments").innerHTML += '<li class="media mb-3">' +
            '<img src="{{ asset("img/default.png") }}" class="mr-3 com-avatare rounded-circle" alt="avatar">' +
            '<div class="media-body">' +
            '<h5 class="mt-0 mb-3"><a href="#" class="_link">Ahmed Essoubai</h5></a>' +
            '<p>' + document.getElementById("content").value + '</p>' +
            '<small class="text-muted">' + (new Date()) + '</small>' +
            '</div>' +
            '</li>';
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "/comments/?post={{ $post->id }}&content=" + document.getElementById("content").value, true);
        xhttp.send();
    }

    function favorite() {
        if (document.getElementById("MyElement").classList.contains('MyClass'))
            document.getElementById("count").innerHTML = document.getElementById("count").innerHTML + 1;
        document.getElementById("comments").innerHTML += '<li class="media mb-3">' +
            '<img src="{{ asset("img/default.png") }}" class="mr-3 com-avatare rounded-circle" alt="avatar">' +
            '<div class="media-body">' +
            '<h5 class="mt-0 mb-3"><a href="#" class="_link">Ahmed Essoubai</h5></a>' +
            '<p>' + document.getElementById("content").value + '</p>' +
            '<small class="text-muted">' + (new Date()) + '</small>' +
            '</div>' +
            '</li>';
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "/comments/?post={{ $post->id }}&content=" + document.getElementById("content").value, true);
        xhttp.send();
    }
</script>
@endsection