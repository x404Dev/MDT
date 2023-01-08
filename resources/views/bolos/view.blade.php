@extends('layouts.app')

@section('content')
    <a class="btn btn-link pl-1 pd-3"
        href="{{ route('bolos.index') }}"><i class="far fa-arrow-alt-circle-left"></i>
        Retour</a>
    <div class="card shadow"
        style="max-height: 80vh;">
        <div class=" card-header py-3 ">
            <p class="text-primary m-0 font-weight-bold ">BOLO #{{ $bolo->id }}</p>
        </div>
        <div class="card-body"
            style="overflow-y:scroll;">
            <div class="row">
                <div class="col-11 m-auto">
                    <form action="{{ route('bolos.update', $bolo->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group">
                            <label for="dossier-num"
                                class="mr-4 mt-2">BOLO #: </label>
                            <input id="dossier-num"
                                class="dossier-input-red"
                                readonly="readonly"
                                value="{{ $bolo->id }}"
                                style="width: 15% !important"
                                placeholder="Nom">
                            <div class="ml-auto">
                                @if (auth()->user()->role_id == 1)
                                    <button id="btn-del-dos"
                                        class="btn save-btn"
                                        data-toggle="modal"
                                        data-target="#deleteModal"
                                        type="button"><i class="far fa-trash-alt"></i> Supprimer</button>
                                @endif
                                <button class="btn save-btn"
                                    type="submit"><i class="far fa-save"></i>
                                    Sauvegarder</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group my-3">
                                    <label for="nom"
                                        class="mr-2">Nom: </label>
                                    <input type="text"
                                        required
                                        id="nom"
                                        value="{{ old('nom', $bolo->nom) }}"
                                        class="dossier-input"
                                        name="nom"
                                        placeholder="Nom">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group my-3">
                                    <label for="type">Type</label>
                                    <select name="type"
                                        class="form-control"
                                        id="type">
                                        <option @if ($bolo->type == 'arme') selected @endif
                                            value="arme">Arme</option>
                                        <option @if ($bolo->type == 'vehicule') selected @endif
                                            value="vehicule">Véhicule</option>
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
                                        placeholder="Informations">{{ old('notes', $bolo->notes) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->role_id == 1)
    <div class="modal fade"
        id="deleteModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="deleteModalLabel">Confirmation</h5>
                    <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Veuillez cliquer le boutton supprimer pour confirmer! Cette action est irréversible!
                </div>
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">Fermer</button>
                    <form method="POST"
                        action="{{ route('bolos.destroy', $bolo->id) }}">@csrf @method('DELETE')<button
                            type="submit"
                            class="btn btn-danger">Supprimer</button></form>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
