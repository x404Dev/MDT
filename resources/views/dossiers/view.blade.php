@extends('layouts.app')

@section('content')
    <a class="btn btn-link pl-1 pd-3" href="{{ url()->previous() }}"><i class="far fa-arrow-alt-circle-left"></i> Retour</a>
    <div class="card shadow" style="max-height: 80vh;">
        <div class=" card-header py-3 ">
            <p class="text-primary m-0 font-weight-bold ">Dossier de citoyen</p>
        </div>
        <div class="card-body" style="overflow-y:scroll;">
            <div class="row ">
                <div class="col-7">
                    <form action="{{ route("dossiers.update", $dossier->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="input-group">
                            <label for="dossier-num" class="mr-4 mt-2">Dossier #: </label>
                            <input id="dossier-num" class="dossier-input-red" readonly="readonly" value="{{ $dossier->id }}"style="width: 15% !important" placeholder="Nom">
                            <div class="ml-auto">
                                @if (auth()->user()->role_id == 1)
                                    <button id="btn-del-dos" class="btn save-btn" data-toggle="modal" data-target="#deleteModal" type="button"><i
                                            class="far fa-trash-alt"></i> Supprimer</button>
                                @endif
                                <a href="{{ route('dossiers.index', $dossier->id) }}" class="btn save-btn" role="button"><i class="fas fa-hand-paper"></i> Mandat</a>
                                <button class="btn save-btn ml-auto" type="submit"><i class="far fa-save"></i> Sauvegarder</button>
                            </div>
                        </div>
                        <hr>
                        <div class="input-group my-3">
                            <label for="nom" class="mr-4">Nom: </label>
                            <input type="text" required id="nom" class="dossier-input" name="nom" value="{{ $dossier->nom }}" placeholder="Nom">
                        </div>
                        <div class="input-group my-3">
                            <label for="tel" class="mr-4">Téléphone: </label>
                            <input type="text" id="tel" class="dossier-input" name="telephone" value="{{ $dossier->telephone }}" placeholder="Téléphone">
                        </div>
                        <div class="input-group my-3">
                            <label for="job" class="mr-4">Emploi: </label>
                            <input type="text" id="job" class="dossier-input" name="emploi" value="{{ $dossier->emploi }}" placeholder="Emploi">
                        </div>
                        <div class="input-group my-3">
                            <label for="photo" class="mr-4">Photo: </label>
                            <input type="text" id="photo" class="dossier-input" name="photo"  value="{{ $dossier->photo }}" placeholder="URL de la Photo">
                        </div>
                        <div class="input-group my-3">
                            <label for="desc" class="mr-4">Informations: </label>
                            <textarea id="desc" class="dossier-input" name="notes" placeholder="Informations">{{$dossier->notes}}</textarea>
                        </div>
                    </form>
                </div>
                <div class="col-5 text-center">
                    <img class="profile-pic mb-4" src="{{ $dossier->photo }}" onerror="this.onerror=null;this.src='https://i.imgur.com/t0xtViO.jpg'">
                    <div class="col-10 m-auto">
                        <div class="card shadow mt-4" style="height: 385px;">
                            <div class=" card-header py-3 ">
                                <a class="btn save-btn-sm float-right"
                                    href=""><i
                                        class="far fa-plus-square"></i> Nouveau</a>
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
    @if (auth()->user()->role_id == 1)
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Veuillez cliquer le boutton supprimer pour confirmer! Cette action est irréversible!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-danger">Supprimer</button>
            </div>
          </div>
        </div>
      </div>
      @endif
@endsection