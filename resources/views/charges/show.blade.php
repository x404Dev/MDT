@extends('layouts.app')

@section('content')
    <a class="btn btn-link pl-1 pd-3" href="{{ route("charges.index") }}"><i class="far fa-arrow-alt-circle-left"></i>
        Retour</a>
    <div class="card shadow" style="max-height: 80vh;">
        <div class=" card-header py-3 ">
            <p class="text-primary m-0 font-weight-bold ">{{ $charge->nom }}</p>
        </div>
        <div class="card-body" style="overflow-y:scroll;">
            <div class="row">
                <div class="col-11 m-auto">
                    <form action="{{ route('charges.update', $charge->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group">
                            <label for="dossier-num" class="mr-4 mt-2">Charge #: </label>
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
                                    <input type="text" id="nom" value="{{ $charge->nom }}" class="dossier-input" name="nom"
                                        placeholder="Nom">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group my-3">
                                    <label for="cout" class="mr-2">Coût: </label>
                                    <input type="number" required id="cout" value="{{ $charge->cout }}" class="dossier-input" value="0" name="cout"
                                        placeholder="Coût">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group my-3">
                                    <label for="mois" class="mr-2">Mois: </label>
                                    <input type="number" required id="mois" value="{{ $charge->mois }}" class="dossier-input" value="0" name="mois"
                                        placeholder="Mois">
                                </div>
                            </div>
                        </div>
                    </form>
                    <em>*Pour supprimer la charge, sauvegarder la charge sans le titre.</em>
                </div>
            </div>
        </div>
    </div>
@endsection
