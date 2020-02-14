@extends('layouts.app')

@section('content')
<section>
    <div class="py-5 text-left bg-light" id="groupe">
        <div class="container">
            <div class="row bg-white shadow border">
                <div class="col p-0">
                    <div class="p-3 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <a href="\profils\{{ $post->compte->id }}"><img src="{{ $post->compte->image }}" alt="profile image" class="avatare img-fluid rounded-circle" /></a>
                            <div class="ml-3 d-flex flex-column">
                                <a class="_link" href="\profils\{{ $post->compte->id }}">{{ $post->compte->prenom }} {{ $post->compte->nom }}</a>
                                <a class="_sec_link" href="/groupes/{{ $post->groupe->id }}"><span>{{ $post->groupe->label }}</span></a>
                            </div>
                        </div>
                        @if ($post->can_delete(Auth::user()))
                        <div class="d-flex pr-3 align-items-center dropdown">
                            <span class="icon-mute" id="post_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="post_options">
                                @if ($post->can_edit(Auth::user()))
                                <a class="dropdown-item" href="/posts/{{ $post->id }}/editer">Éditer</a>
                                @endif
                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#delete_post">Supprimer</button>
                            </div>
                        </div>
                        @endif
                    </div>
                    <div class="card">
                        @if (!empty($post->image))
                            <img src="/storage/{{ $post->image }}" class="card-img-top" alt="post image">
                        @endif
                        <div class="card-body">
                            <div class="pb-3 d-flex justify-content-between">
                                <div>
                                    <a class="icon mr-3" onclick="favorite({{ $post->id }})">
                                        <i id="fa_{{ $post->id }}_fav" class=" 
                                        @if ($post->is_liked())
                                            fa fa-heart active
                                        @else
                                            far fa-heart
                                        @endif
                                        text-grey" aria-hidden="true"></i>
                                    </a>
                                    <a class="icon" onclick="bookmark({{ $post->id }})">
                                        <i id="fa_{{ $post->id }}_book" class=" 
                                        @if ($post->is_bookmarked())
                                            fa fa-bookmark active
                                        @else
                                            far fa-bookmark
                                        @endif
                                        text-grey" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                            <h5 class="card-title">{{ $post->titre }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted"><span id="likes_{{ $post->id }}">{{ $post->favorited_users->count() }}</span> j'aime</h6>
                            <p class="card-text">{{ $post->content }}</p>
                            <p class="card-text"><small class="text-muted">{{ \Carbon\Carbon::parse($post->date_publication)->format('d M Y h:i')}}</small></p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted"><span id="count">{{ $post->comments->count()}}</span> commentaires</small>
                        </div>
                    </div>
                    <div class="p-4">
                        <ul id="comments" class="list-unstyled">
                            @foreach($post->comments as $comment)
                            <li id="c_{{ $comment->id }}">
                                <div class="media mb-3">
                                    <a href="\profils\{{ $comment->compte_id }}"><img src="{{ $comment->user->image }}" class="mr-3 com-avatare rounded-circle" alt="avatar"></a>
                                    <div class="media-body d-flex justify-content-between">
                                        <div>
                                            <h5 class="mt-0 mb-3"><a href="\profils\{{ $comment->compte_id }}" class="_link">{{ $comment->user->prenom }} {{ $comment->user->nom }}</h5></a>
                                            <p id="cmt_{{ $comment->id }}_content">{{ $comment->content }}</p>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($comment->date_publication)->format('m-m-Y h:i')}}</small>
                                        </div>
                                        @if ($comment->can_delete(Auth::user()))
                                        <div class="d-flex mb-4 pr-5 align-items-center dropdown">
                                            <span class="icon-mute-2" id="post_{{ $comment->id }}_options" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></span>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="cmt_{{ $comment->id }}_options">
                                                @if ($comment->can_edit(Auth::user()))
                                                <button class="dropdown-item" type="button" data-toggle="modal" data-target="#edit_comment" data-id="{{ $comment->id }}">Éditer</button>
                                                @endif
                                                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_comment" data-id="{{ $comment->id }}">Supprimer</a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
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
                        <div class="modal fade" id="edit_comment" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">Modifier le commentaire</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input id="comment-id" type="hidden" />
                                        <textarea class="form-control" id="comment-text"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="editComment()">Mettre à jour le commentaire</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete_comment" tabindex="-1" role="dialog" aria-labelledby="dc-modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <input id="d-comment-id" type="hidden" />
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="dc-modalLabel">Supprimer le commentaire</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        êtes-vous sûr de cela
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deleteComment()">Supprimer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete_post" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="dp-modalLabel">Supprimer le post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    êtes-vous sûr de cela
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a class="btn btn-danger" href="/posts/d/{{ $post->id }}">Supprimer</a>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function addComment() {
        var xhttp = new XMLHttpRequest();
        /*xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert('Salam');
                document.getElementById("count").innerHTML = Number(document.getElementById("count").innerHTML) + 1;
                var comt = JSON.parse(this.responseText);
                document.getElementById("comments").innerHTML += comt;
                /*var d = new Date(comt.date_publication);
                var dateString =
                    ("0" + d.getUTCDate()).slice(-2) + "-" +
                    ("0" + (d.getUTCMonth()+1)).slice(-2) + "-" +
                    d.getUTCFullYear() + " " +
                    ("0" + d.getUTCHours()).slice(-2) + ":" +
                    ("0" + d.getUTCMinutes()).slice(-2);
                document.getElementById("comments").innerHTML += '<li id="' + comt.id + '" class="media mb-3">' +
                    '<img src="{{ Auth::user()->image }}" class="mr-3 com-avatare rounded-circle" alt="avatar">' +
                    '<div class="media-body">' +
                    '<h5 class="mt-0 mb-3"><a href="#" class="_link">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h5></a>' +
                    '<p>' + {{--document.getElementById("content").value--}}comt.content + '</p>' +
                    '<small class="text-muted">' + dateString + '</small>' +
                    '</div>' +
                    '</li>';
            }
        };*/
        document.getElementById("count").innerHTML = Number(document.getElementById("count").innerHTML) + 1;
        var d = new Date();
        var dateString =
            ("0" + d.getUTCDate()).slice(-2) + "-" +
            ("0" + (d.getUTCMonth()+1)).slice(-2) + "-" +
            d.getUTCFullYear() + " " +
            ("0" + d.getUTCHours()).slice(-2) + ":" +
            ("0" + d.getUTCMinutes()).slice(-2);
        document.getElementById("comments").innerHTML += '<li class="media mb-3">' +
            '<a href="\profils\{{ Auth::user()->id }}"><img src="{{ Auth::user()->image }}" class="mr-3 com-avatare rounded-circle" alt="avatar"></a>' +
            '<div class="media-body">' +
            '<h5 class="mt-0 mb-3"><a href="\profils\{{ Auth::user()->id }}" class="_link">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h5></a>' +
            '<p>' + document.getElementById("content").value + '</p>' +
            '<small class="text-muted">' + dateString + '</small>' +
            '</div>' +
            '</li>';
        xhttp.open("GET", "/comments/?post={{ $post->id }}&content=" + document.getElementById("content").value, true);
        xhttp.send();
        document.getElementById("content").value = '';
    }

    function deleteComment() {
        document.getElementById("count").innerHTML = Number(document.getElementById("count").innerHTML) - 1;
        var id = document.getElementById("d-comment-id").value;
        document.getElementById('c_' + id).innerHTML = 
            '<div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">' +
            'Un commentaire a été supprimé!' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' + 
                '<span aria-hidden="true">&times;</span>' + 
            '</button>' + 
            '</div>';
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "/comments/d/" + id, true);
        xhttp.send();
    }
//This is my first edited comment
    function editComment() {
        var id = document.getElementById("comment-id").value;
        document.getElementById("cmt_" + id + "_content").innerHTML =  document.getElementById("comment-text").value;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "/comments/" + id + "/update?content=" + document.getElementById("comment-text").value, true);
        xhttp.send();
    }

    $(document).ready(function(){
        $('#edit_comment').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes
            var modal = $(this);
            //modal.find('#ctext').text($('#cmt_' + id + '_content').text());
            modal.find('#comment-id').val(id);
            modal.find('#comment-text').val($('#cmt_' + id + '_content').text());
        });
        $('#delete_comment').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('#d-comment-id').val(id);
        });
    });
</script>
<script type="text/javascript" src="{{ asset("js/post-scripts.js") }}"></script>
@endsection