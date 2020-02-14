@extends('layouts.app')

@section('content')
<section>
    <div class="py-5 text-left bg-light" id="groupe">
        <div class="container">
            <div class="row">
                <div class="col-md-6 my-3 p-0">
                    <div class="bg-white shadow-sm mx-3 p-3 h-100">
                        <form method="POST" enctype="multipart/form-data" action="/posts/{{ $post->id }}">
                            @csrf
                            @method('PATCH')

                            <h3 class="mt-2 mb-4">
                                Editer
                            </h3>
                            <input id="in_titre" type="text" name="titre" onkeypress="changed('titre')" class="form-control my-2 @error('titre') is-invalid @enderror" value="{{ old('titre') ?? $post->titre }}" placeholder="Titre du post" autofocus require />
                            @error('titre')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <textarea id="in_content" style="height: 350px" class="form-control my-2 @error('content') is-invalid @enderror" name="content" onkeypress="changed('content')" rows="4" placeholder="Partager vos idées" require>{{ old('content') ?? $post->content }}</textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="custom-file my-2 @error('image') is-invalid @enderror">
                                <input id="in_image" type="file" name="image" onchange="onImageChanged()" class="custom-file-input" value="{{ old('image') }}" id="postImage">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="custom-file-label" for="postImage">Choisir image</label>
                            </div>
                            <button type="submit" class="btn btn-primary form-control my-2">Sauvegarder les modifications</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 my-3 p-0">
                    <div class="bg-white shadow-sm mx-3">
                        <h3 class="px-3 pt-4 pb-2">
                            Aperçu
                        </h3>
                        <div class="p-3 d-flex align-items-center">
                            <a href="\profils\{{ $post->compte->id }}"><img src="{{ $post->compte->image }}" alt="profile image" class="avatare img-fluid rounded-circle" /></a>
                            <div class="ml-3 d-flex flex-column">
                                <a class="_link" href="\profils\{{ $post->compte->id }}">{{ $post->compte->prenom }} {{ $post->compte->nom }}</a>
                                <a class="_sec_link" href="/groupes/{{ $post->groupe->id }}"><span>{{ $post->groupe->label }}</span></a>
                            </div>
                        </div>
                        <div class="card">
                            <img id="out_image" src="/storage/{{ $post->image }}" class="card-img-top" alt="post image">
                            <div class="card-body">
                                <h5 id="out_titre" class="card-title">{{ $post->titre }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><span id="likes">{{ $post->favorited_users->count() }}</span> j'aime</h6>
                                <p id="out_content" class="card-text">{{ $post->content }}</p>
                                <p class="card-text"><small class="text-muted">{{ \Carbon\Carbon::parse($post->date_publication)->format('d M Y h:i')}}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function changed(key) {
        document.getElementById("out_" + key).innerHTML = document.getElementById("in_" + key).value;
    }

    function onImageChanged()
    {
        var files = document.getElementById("in_image").files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function (theFile) {
                document.getElementById("out_image").src = fr.result;
            }
            fr.readAsDataURL(files[0]);
        }        
    }

    /*function imageChanged() {
        console.log('Step 1');
        var f = document.getElementById("in_image").files[0];

        // Only process image files.
        if (!f.type.match('image.*')) {
            continue;
        }

        console.log('Step 2');

        var reader = new FileReader();

        // Closure to capture the file information.
        reader.onload = (function(theFile) {
            return function(e) {
                console.log('Step 3');
                // Render thumbnail.
                var span = ;
                document.createElement('out_image').src = e.target.result;
                document.getElementById('list').insertBefore(span, null);
            };
        })(f);

        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
    }*/
</script>
@endsection