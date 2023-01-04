@extends('layouts.app')

@section('content')
    <a class="btn btn-link pl-1 pd-3" href="{{ url()->previous() }}"><i class="far fa-arrow-alt-circle-left"></i> Retour</a>
    <div class="card shadow" style="max-height: 80vh;">
        <div class=" card-header py-3 ">
            <p class="text-primary m-0 font-weight-bold ">Nouveau Dossier</p>
        </div>
        <div class="card-body" style="overflow-y:scroll;">
            <div class="row ">
                <div class="col-7">
                    <form action="{{ route("dossiers.store") }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <label for="dossier-num" class="mr-4 mt-2">Dossier #: </label>
                            <input id="dossier-num" class="dossier-input-red" readonly="readonly" value="00"style="width: 15% !important" placeholder="Nom">
                            <button class="btn save-btn ml-auto" type="submit"><i class="far fa-save"></i> Sauvegarder</button>
                        </div>
                        <hr>
                        <div class="input-group my-3">
                            <label for="nom" class="mr-4">Nom: </label>
                            <input type="text" required id="nom" class="dossier-input" name="nom" placeholder="Nom">
                        </div>
                        <div class="input-group my-3">
                            <label for="tel" class="mr-4">Téléphone: </label>
                            <input type="text" id="tel" class="dossier-input" name="telephone" placeholder="Téléphone">
                        </div>
                        <div class="input-group my-3">
                            <label for="job" class="mr-4">Emploi: </label>
                            <input type="text" id="job" class="dossier-input" name="emploi" placeholder="Emploi">
                        </div>
                        <div class="input-group my-3">
                            <label for="photo" class="mr-4">Photo: </label>
                            <input type="text" id="photo" class="dossier-input" name="photo" placeholder="URL de la Photo">
                        </div>
                        <div class="input-group my-3">
                            <label for="desc" class="mr-4">Informations: </label>
                            <textarea id="desc" class="dossier-input" name="notes" placeholder="Informations"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-5 text-center">
                    <img class="profile-pic mb-4" src="https://i.imgur.com/t0xtViO.jpg">
                    <div class="col-10 m-auto">
                        <div class="card shadow mt-4" style="height: 385px;">
                            <div class=" card-header py-3 ">
                                <p class="text-primary m-0 mt-1 font-weight-bold text-left">Rapports</p>
                            </div>
                            <div class="card-body" style="overflow-y:scroll;">
                                <div class="row">
                                    <p class="mx-auto">Aucun Rapport!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection