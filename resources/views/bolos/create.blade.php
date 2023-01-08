@extends('layouts.app')

@section('content')
    <a class="btn btn-link pl-1 pd-3" href="{{ route('bolos.index') }}"><i class="far fa-arrow-alt-circle-left"></i>
        Retour</a>
    <div class="card shadow" style="max-height: 80vh;">
        <div class=" card-header py-3 ">
            <p class="text-primary m-0 font-weight-bold ">Nouveau BOLO</p>
        </div>
        <div class="card-body" style="overflow-y:scroll;">
            <div class="row">
                <div class="col-11 m-auto">
                    <form action="{{ route('bolos.store') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <label for="dossier-num" class="mr-4 mt-2">BOLO #: </label>
                            <input id="dossier-num" class="dossier-input-red" readonly="readonly" value="00"
                                style="width: 15% !important" placeholder="Nom">
                            <button class="btn save-btn ml-auto" type="submit"><i class="far fa-save"></i>
                                Sauvegarder</button>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group my-3">
                                    <label for="nom" class="mr-2">Nom: </label>
                                    <input type="text" required id="nom" value="{{ old('nom') }}" class="dossier-input" name="nom"
                                        placeholder="Nom">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group my-3">
                                    <label for="type">Type</label>
                                    <select name="type" class="form-control" id="type">
                                      <option value="arme">Arme</option>
                                      <option value="vehicule">Véhicule</option>
                                    </select>
                                  </div>
                            </div>
                            <div class="col-12">
                                <div class="input-group my-3">
                                    <label for="desc"
                                        class="mr-4">Informations: </label>
                                    <textarea id="desc"
                                        class="dossier-input"
                                        name="notes"
                                        placeholder="Informations">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
