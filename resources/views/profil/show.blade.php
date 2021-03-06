@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light" id="profil">
    <div class="container">
        <div class="row bg-white shadow-sm">
            <div class="col p-0 border">
                <div id="cover"></div>
                <div class="p-4">
                    <img id="profil-avatar" src="{{ $user->image }}" class="img-fluid rounded-circle">
                    <div id="name" class="my-3">
                        <h2>{{ $user->prenom }} {{ $user->nom }}</h2>
                        <small class="text-muted">{{ $user->niveau }}</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="container px-0">
                <div class="row">
                    <div class="col-md-8">
                        @if ($user->id == Auth::id())
                        <!-- New post -->
                        <div id="newPost" class="bg-white p-3 shadow-sm border mb-5">
                            <form method="POST" enctype="multipart/form-data" action="{{ route('posts') }}">
                                @csrf
                                <h3 class="mb-3">
                                    Nouveau post
                                </h3>
                                <input id="titre" type="text" name="titre" class="form-control my-2 @error('titre') is-invalid @enderror" value="{{ old('titre') }}" placeholder="Titre du post" required/>
                                @error('titre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <textarea id="content" class="form-control my-2 @error('content') is-invalid @enderror" name="content" rows="4" placeholder="Partager vos idées" required>{{ old('content') }}</textarea>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="custom-file my-2 @error('image') is-invalid @enderror">
                                    <input id="image" type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" value="{{ old('image') }}" id="postImage">
                                    <label class="custom-file-label" for="postImage">Choisir image</label>
                                </div>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="form-group my-2">
                                    <label for="groupe_id">Groupe</label>
                                    <select id="groupe_id" name="groupe_id" class="form-control @error('groupe_id') is-invalid @enderror" required>
                                        @foreach ($user->founding_groupes as $g)
                                        <option value="{{ $g->id }}" @if(old('groupe_id') == $g->id) selected @endif>{{ $g->label }}</option>
                                        @endforeach
                                        @foreach ($user->joined_groupes as $g)
                                        <option value="{{ $g->id }}" @if(old('groupe_id') == $g->id) selected @endif>{{ $g->label }}</option>
                                        @endforeach
                                    </select>
                                    @error('groupe_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary form-control my-2">Publier</button>
                            </form>
                        </div>
                        @endif
                        <!-- POSTS -->
                        @foreach($user->posts as $post)
                            @if($user->id == Auth::id() || $post->groupe->is_public() || $post->groupe->is_member())
                                <div id="p_{{ $post->id}}">
                                    <div class="bg-white rounded shadow-sm border mb-5">
                                        <div class="p-3 d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <a href="#"><img src="{{ $post->compte->image }}" alt="profile image" class="avatare img-fluid rounded-circle" /></a>
                                                <div class="ml-3 d-flex flex-column">
                                                    <a class="_link" href="#">{{ $post->compte->prenom }} {{ $post->compte->nom }}</a>
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
                                                    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#delete_post" data-id="{{ $post->id }}">Supprimer</a>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="card">
                                            <a href="\posts\{{ $post->id }}"><img src="/storage/{{ $post->image }}" class="card-img-top" alt="post image"></a>
                                            <div class="card-body">
                                                <div class="pb-3">
                                                    @if($post->groupe->is_member())
                                                    <a class="icon mr-3" onclick="favorite({{ $post->id }})">
                                                        <i id="fa_{{ $post->id }}_fav" class="
                                                        @if ($post->is_liked())
                                                            fa fa-heart active
                                                        @else
                                                            far fa-heart
                                                        @endif
                                                        text-grey" aria-hidden="true"></i>
                                                    </a>
                                                    @endif
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
                                                <h5 class="card-title">{{ $post->titre }}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted"><span id="likes">{{ $post->favorited_users->count() }}</span> j'aime</h6>
                                                <p class="card-text">{{ $post->content }}</p>
                                                <p class="card-text"><small class="text-muted">{{ \Carbon\Carbon::parse($post->date_publication)->format('d M Y h:i')}}</small></p>
                                            </div>
                                            <div class="card-footer">
                                                <a href="\posts\{{ $post->id }}"><small class="text-muted">{{ $post->comments->count() }} commentaires</small></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        @if ($user->posts->count() == 0)
                            <div class="text-muted text-center py-5 px-2">
                                <h2 class="my-3" style="font-size: 3em"><i class="fas fa-cloud-showers-heavy"></i></h2>
                                <h4 class="my-3">Aucun post à afficher</h4>
                            </div>
                        @endif
                    </div>
                    <!--Groupes list-->
                    <div class="col-md-4">
                        <div class="bg-white py-3 shadow-sm border mb-5">
                            <h5 class="mx-3 mb-3">
                                Groupes fondés
                            </h5>
                            <div class="list-group">
                                @foreach ($user->groupes as $g)
                                <a href="/groupes/{{ $g->id }}" class="list-group-item d-flex align-items-center border-left-0 border-right-0">
                                    <img class="img-fluid groupe-icon mr-3" src="{{ $g->get_icon() }}" />
                                    {{ $g->label }}
                                </a>
                                @endforeach
                            </div>
                            @if ($user->id == Auth::id())
                            <div class="text-center mt-3">
                                <a href="{{ route('groupes.list') }}" class="_link px-3">Afficher tous</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete_post" tabindex="-1" role="dialog" aria-labelledby="dp-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <input id="d-post-id" type="hidden" />
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="deletePost()">Supprimer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset("js/post-scripts.js") }}"></script>
</section>
@endsection