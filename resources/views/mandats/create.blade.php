@extends('layouts.app')

@section('content')
    <a class="btn btn-link pl-1 pd-3" href="{{ route('dossiers.show', $dossier->id) }}"><i class="far fa-arrow-alt-circle-left"></i>
        Retour</a>
    <div class="card shadow" style="max-height: 80vh;">
        <div class=" card-header py-3 ">
            <p class="text-primary m-0 font-weight-bold ">Nouveau Mandat</p>
        </div>
        <div class="card-body" style="overflow-y:scroll;">
            <div class="row ">
                <div class="col-7">
                    <form action="{{ route('mandats.store', $dossier->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="charges" value="" class="charges-list">
                        <div class="input-group">
                            <label for="dossier-num" class="mr-4 mt-2">Rapport #: </label>
                            <input id="dossier-num" class="dossier-input-red" readonly="readonly" value="00"
                                style="width: 15% !important" placeholder="Rapport ID">
                            <button class="btn save-btn ml-auto" type="submit"><i class="far fa-save"></i>
                                Sauvegarder</button>
                        </div>
                        <hr>
                        <div class="input-group my-3">
                            <label for="nom" class="mr-4">Dossier: </label>
                            <input type="text" readonly="readonly" id="titre" class="dossier-input-red"
                                value="{{ $dossier->nom }}" name="nom" placeholder="Dossier">
                        </div>
                        <div class="input-group my-3">
                            <label for="titre" class="mr-4">Titre: </label>
                            <input type="text" required id="titre" value="{{ old('titre') }}" class="dossier-input" name="titre" placeholder="Titre">
                        </div>
                        <div class="input-group my-3">
                            <label for="notes" class="mr-4">Informations: </label>
                            <textarea id="notes" class="dossier-input" name="notes" placeholder="Informations">{{ old('notes') }}</textarea>
                        </div>
                    </form>
                </div>
                <div class="col-5 text-center">
                    <div class="col-10 m-auto">
                        <div class="card shadow" style="height: 100%">
                            <div class=" card-header py-3 ">
                                <button type="button" data-toggle="modal" data-target="#itemsModal"
                                    class="btn save-btn-sm float-right"><i class="far fa-plus-square"></i> Modifier</button>
                                <p class="text-primary m-0 mt-1 font-weight-bold text-left">Charges</p>
                            </div>
                            <div class="card-body" style="overflow-y:scroll;">
                                <div class="row">
                                    <div class="container charge-list-2">
                                        <hr class="mt-0">

                                    </div>
                                    <div class="container">
                                        <p class="items-total" style="font-weight: bold"><span class="cout-total">0</span>$ | <span class="mois-total">0</span> mois</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="itemsModal" tabindex="-1" role="dialog" aria-labelledby="itemsModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="height: 80vh;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Charges</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="overflow-y:scroll;">
                    <div class="container">
                        <div class="row">
                            @foreach ($charges as $charge)
                                <div class="col-3 text-center" style="padding: 1px !important">
                                    <div class="item-box" style="height: 100px">
                                        <input type="hidden" class="charge-id" value="{{ $charge->id }}">
                                        <h6 class="text-white px-3 pt-3 mb-0 charge-title" style="font-size: 20px">
                                            {{ $charge->nom }}
                                        </h6>
                                        <p class="text-white pt-2" style="font-size: 13px"><span
                                                id="charge-cout">{{ $charge->cout }}</span>$ | <span
                                                id="charge-mois">{{ $charge->mois }}</span> mois</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div>
                            <table class="table my-0 " id="dataTable">
                                <thead>
                                    <tr>
                                        <th style="width:70%">Charges</th>
                                        <th class="text-right">Cout</th>
                                        <th class="text-right">Mois</th>
                                    </tr>
                                </thead>
                                <tbody class="charge-list">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width:70%">Total:</th>
                                        <th class="text-right"><span class="cout-total">0</span>$</th>
                                        <th class="text-right"><span class="mois-total">0</span> Mois</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn blue-btn">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection
