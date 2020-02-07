@extends('layouts.app')

@section('content')
<section class="py-5 text-left bg-light" id="newGroupe">
    <div class="container">
        <div class="row">
            <div class="dropdown col-12">
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <button class="dropdown-item" type="button">Action</button>
                    <button class="dropdown-item" type="button">Another action</button>
                    <button class="dropdown-item" type="button">Something else here</button>
                </div>
            </div>
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
                <form method="POST" action="{{ route('groupe') }}">
                    @csrf
                    <h2 class="mb-5 pt-5 pb-3">
                        Nouveau groupe
                    </h2>
                    <div class="form-groupe my-3">
                        <label class="control-label" for="label">Nom de groupe</label>
                        <input id="label" name="label" type="text" class="form-control @error('label') is-invalid @enderror" placeholder="Enter une label" required autocomplete="nom" autofocus>
                    </div>
                    <div class="form-group my-3">
                        <label for="icon">Icon</label>
                        <select id="icon" name="icon" class="form-control">
                            <option value="0" selected>Icon 0</option>
                            <option value="1">Icon 1</option>
                            <option value="2">Icon 2</option>
                            <option value="3">Icon 3</option>
                            <option value="4">Icon 4</option>
                            <option value="5">Icon 5</option>
                            <option value="6">Icon 6</option>
                        </select>
                    </div>
                    <div class="form-group my-3">
                        <label for="etat">État</label>
                        <select id="etat" name="etat" class="form-control">
                            <option value="public" selected>Public</option>
                            <option value="private">Privé</option>
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