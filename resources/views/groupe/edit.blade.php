@extends('layouts.groupe-admin')

@section('content-3')
<div class="container p-0">
    <div class="row px-4 pt-3 pb-5 bg-white shadow-sm">
        <form class="col" method="POST" enctype="multipart/form-data" action="{{ route('groupes.update', ['groupe' => $groupe]) }}">
            @csrf
            @method('PATCH')

            <h2 class="mb-3 pt-3 pb-3">
                Les information de groupe
            </h2>
            <div class="form-groupe my-3">
                <label class="control-label" for="label">Nom de groupe</label>
                <div>
                    <input id="label" name="label" type="text" value="{{ old('label') ?? $groupe->label }}" class="form-control @error('label') is-invalid @enderror" placeholder="Enter une label" required autocomplete="nom" autofocus>
                    @error('label')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group my-3">
                <label for="etat">Type</label>
                <div>
                    <select id="etat" name="etat" class="form-control @error('etat') is-invalid @enderror" required>
                        <option value="public" @if((old('etat') ?? $groupe->etat) == 'public') selected @endif>Public</option>
                        <option value="private"  @if((old('etat') ?? $groupe->etat) == 'private') selected @endif>Privé</option>
                    </select>
                    @error('etat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group my-3">
                <label for="icon">Icon</label>
                <div>
                    <select id="icon" name="icon" class="form-control @error('icon') is-invalid @enderror" required>
                        <option value="0" @if((old('icon') ?? $groupe->icon) == '0') selected @endif>Icon 0</option>
                        <option value="1" @if((old('icon') ?? $groupe->icon) == '1') selected @endif>Icon 1</option>
                        <option value="2" @if((old('icon') ?? $groupe->icon) == '2') selected @endif>Icon 2</option>
                        <option value="3" @if((old('icon') ?? $groupe->icon) == '3') selected @endif>Icon 3</option>
                        <option value="4" @if((old('icon') ?? $groupe->icon) == '4') selected @endif>Icon 4</option>
                        <option value="5" @if((old('icon') ?? $groupe->icon) == '5') selected @endif>Icon 5</option>
                        <option value="6" @if((old('icon') ?? $groupe->icon) == '6') selected @endif>Icon 6</option>
                    </select>
                    @error('icon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-groupe my-3">
                <label class="control-label" for="description">Description</label>
                <div>
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter une description" required autocomplete="label">{{ old('description') ?? $groupe->description }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-group my-3">
                <label>Couverture</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" value="{{ old('image') }}" id="image" name="image">
                    <label class="custom-file-label" for="image">Choisir image</label>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-groupe mt-5">
                <button type="submit" class="btn btn-primary btn-lg form-control">Sauvegarder les modifications</button>
            </div>
        </form>
    </div>
    <div class="row p-4 mt-5 bg-white shadow-sm">
        <div class="col d-flex">
            <div class="flex-grow-1">
                <h3 class="py-3">Supprimer ce groupe</h3>
                <p>Une fois que vous avez supprimé un groupe, vous ne pouvez plus revenir en arrière. Soyez certain.</p>
            </div>
            <a class="btn btn-od align-self-center" data-toggle="modal" data-target="#delete_groupe">Supprimer</a>
        </div>
    </div>
    <div class="modal fade" id="delete_groupe" tabindex="-1" role="dialog" aria-labelledby="dg-modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dg-modalLabel">Supprimer le groupe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    êtes-vous sûr de cela
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="d-link" class="btn btn-danger" href="/groupes/d/{{ $groupe->id }}">Supprimer</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection