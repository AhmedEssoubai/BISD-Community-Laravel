@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light">
    <div class="container" style="min-height: 60vh">
        <div class="row">
            <h2 class="mb-5">Vos posts enregistrés</h2>
        </div>
        <div class="row mt-4">
            @foreach($posts as $post)
            <div class="col-md-4 px-2 mb-5">
              <div class="bg-white rounded shadow-sm border">
                <div class="card">
                    <a href="\posts\{{ $post->id }}"><img src="/storage/{{ $post->image }}" class="card-img-top" alt="post image"></a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->titre }}</h5>
                        <a href="/groupes/{{ $post->groupe->id }}" class="_link">{{ $post->groupe->label }}</a>
                        <p class="card-text mt-2">
                            <small class="text-muted">{{ \Carbon\Carbon::parse($post->date_publication)->format('d M Y h:i')}}</small>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="/posts/{{ $post->id }}"><small class="text-muted">Voir post</small></a>
                    </div>
                </div>
              </div>
            </div>
            @endforeach
        </div>
        @if ($posts->count() == 0)
            <div class="row my-3">
                <div class="col text-muted text-center py-2 px-2">
                    <h2 class="my-3" style="font-size: 3em"><i class="fas fa-book"></i></h2>
                    <h4 class="my-3">Aucun signet à afficher</h4>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection