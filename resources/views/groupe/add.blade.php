@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light" id="newGroupe">
    <div class="container">
        <div class="row">
            <div class="col-md-5 p-5 my-3 bg-white shadow">
                <h2 class="mb-2 pb-3">
                    Créer votre groupe maintenant !
                </h2>
                <ul>
                    <li class="py-2">Partager vos connaissence avec les membres du groupe.</li>
                    <li class="py-2">Vous pouvez mettre le groupe privée ou public selon votre choix. </li>
                    <li class="py-2">Vous supprimer le groupe que vous avez créer lorsque vous voulez</li>
                    <li class="py-2">Vous pouvez ajouter des membres aux votre groupe </li>
                </ul>
            </div>
            <div id="forme" class="col-md-5 offset-sm-1 p-5 my-3 bg-white shadow">
                <form method="POST" action="{{ route('groupes') }}">
                    @csrf
                    <h2 class="mb-5 pt-5 pb-3">
                        Nouveau groupe
                    </h2>
                    <div class="form-groupe my-3">
                        <label class="control-label" for="label">Nom de groupe</label>
                        <div>
                            <input id="label" name="label" type="text" class="form-control @error('label') is-invalid @enderror" placeholder="Enter une label" required autocomplete="nom" autofocus>
                            @error('label')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="etat">Type</label>
                        <select id="etat" name="etat" class="form-control">
                            <option value="public" @if(old('etat') == 'public') selected @endif>Public</option>
                            <option value="private"  @if(old('etat') == 'private') selected @endif>Privé</option>
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <label for="icon">Icon</label>
                        <select id="icon" name="icon" class="form-control">
                            <option value="0" @if(old('icon') == '0') selected @endif>Icon 0</option>
                            <option value="1" @if(old('icon') == '1') selected @endif>Icon 1</option>
                            <option value="2" @if(old('icon') == '2') selected @endif>Icon 2</option>
                            <option value="3" @if(old('icon') == '3') selected @endif>Icon 3</option>
                            <option value="4" @if(old('icon') == '4') selected @endif>Icon 4</option>
                            <option value="5" @if(old('icon') == '5') selected @endif>Icon 5</option>
                            <option value="6" @if(old('icon') == '6') selected @endif>Icon 6</option>
                        </select>
                    </div>
                    <div class="form-groupe mt-5">
                        <button type="submit" class="btn btn-primary btn-lg form-control">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection