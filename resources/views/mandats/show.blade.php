@extends('layouts.app')

@section('content')
    <a class="btn btn-link pl-1 pd-3"
        href="{{ route('mandats.index') }}"><i class="far fa-arrow-alt-circle-left"></i> Retour</a>
    <div class="card shadow"
        style="max-height: 80vh;">
        <div class=" card-header py-3 ">
            <p class="text-primary m-0 font-weight-bold ">{{ $mandat->titre }}</p>
        </div>
        <div class="card-body"
            style="overflow-y:scroll;">
            <div class="row ">
                <div class="col-7">
                    <form action="{{ route('mandats.update', $mandat->id) }}"
                        method="POST">
                        @csrf
                        <input type="hidden"
                            name="_method"
                            value="PUT">
                        <input type="hidden"
                            name="charges"
                            value="{{ $mandat->charges }}"
                            class="charges-list">
                        <div class="input-group">
                            <label for="dossier-num"
                                class="mr-4 mt-2">Mandat #: </label>
                            <input id="dossier-num"
                                class="dossier-input-red"
                                readonly="readonly"
                                value="{{ $mandat->id }}"
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
                        <div class="input-group my-3">
                            <label for="nom"
                                class="mr-4">Dossier: </label>
                            <input type="text"
                                readonly="readonly"
                                id="nom"
                                class="dossier-input-red"
                                value="{{ $mandat->dossier->nom }}"
                                name="name"
                                placeholder="Nom">
                        </div>
                        <div class="input-group my-3">
                            <label for="titre"
                                class="mr-4">Titre: </label>
                            <input type="text"
                                required
                                id="titre"
                                class="dossier-input"
                                value="{{ $mandat->titre }}"
                                name="titre"
                                placeholder="Titre">
                        </div>
                        <div class="input-group my-3">
                            <label for="desc"
                                class="mr-4">Informations: </label>
                            <textarea id="desc"
                                class="dossier-input"
                                name="notes"
                                placeholder="Infos">{{ $mandat->notes }}</textarea>
                        </div>
                        <div class="input-group my-3">
                            <label for="nom"
                                class="mr-4">Créé par: </label>
                            <input type="text"
                                readonly="readonly"
                                id="nom"
                                class="dossier-input-red"
                                value="{{ $mandat->author->name }}"
                                placeholder="Nom">
                        </div>
                    </form>
                </div>
                <div class="col-5 text-center">
                    <div class="col-10 m-auto">
                        <div class="card shadow"
                            style="height: 100%">
                            <div class=" card-header py-3 ">
                                <button type="button"
                                    data-toggle="modal"
                                    data-target="#itemsModal"
                                    class="btn save-btn-sm float-right"><i class="far fa-plus-square"></i> Modifier</button>
                                <p class="text-primary m-0 mt-1 font-weight-bold text-left">Charges</p>
                            </div>
                            <div class="card-body"
                                style="overflow-y:scroll;">
                                <div class="row">
                                    @php
                                        $price = 0;
                                        $mois = 0;
                                    @endphp
                                    <div class="container charge-list-2">
                                        <hr class="mt-0">
                                        @foreach ($charges as $charge)
                                            @php
                                                $chargeOb = App\Models\Charge::find($charge['id']);
                                            @endphp
                                            <div id="charge-a{{ $charge['id'] }}"><a style="display: block">
                                                    {{ $chargeOb->nom }}
                                                    x<span id="charge-amount">{{ $charge['amt'] }}</span></a>
                                                <hr>
                                            </div>
                                            @php
                                                $price = $price + $chargeOb->cout * $charge['amt'];
                                                $mois = $mois + $chargeOb->mois * $charge['amt'];
                                            @endphp
                                        @endforeach
                                    </div>
                                    <div class="container">
                                        <p class="items-total"
                                            style="font-weight: bold"><span
                                                class="cout-total">{{ $price }}</span>$
                                            | <span class="mois-total">{{ $mois }}</span> mois</p>
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
    <div class="modal fade"
        id="itemsModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="itemsModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg"
            role="document">
            <div class="modal-content"
                style="height: 80vh;">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="exampleModalLongTitle">Charges</h5>
                    <button type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"
                    style="overflow-y:scroll;">
                    <div class="container">
                        <div class="row">
                            @foreach ($chargesAll as $charge)
                                <div class="col-3 text-center"
                                    style="padding: 1px !important">
                                    <div class="item-box"
                                        style="height: 100px">
                                        <input type="hidden"
                                            class="charge-id"
                                            value="{{ $charge->id }}">
                                        <h6 class="text-white px-3 pt-3 mb-0 charge-title"
                                            style="font-size: 20px">
                                            {{ $charge->nom }}
                                        </h6>
                                        <p class="text-white pt-2"
                                            style="font-size: 13px"><span id="charge-cout">{{ $charge->cout }}</span>$ |
                                            <span id="charge-mois">{{ $charge->mois }}</span> mois
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div>
                            <table class="table my-0 "
                                id="dataTable">
                                <thead>
                                    <tr>
                                        <th style="width:70%">Charges</th>
                                        <th class="text-right">Cout</th>
                                        <th class="text-right">Mois</th>
                                    </tr>
                                </thead>
                                <tbody class="charge-list">
                                    @foreach ($charges as $charge)
                                        @php
                                            $chargeOb = App\Models\Charge::find($charge['id']);
                                        @endphp
                                        <tr class="charge"
                                            id="charge-{{ $charge['id'] }}">
                                            <td>
                                                {{ $chargeOb->nom }}
                                                x<span id="charge-amount">{{ $charge['amt'] }}</span><button
                                                    class="charge-minus hoveru"
                                                    style="border: none; background-color: transparent; color: red">[-]</button>
                                            </td>
                                            <td class="text-right charge-cout">{{ $chargeOb->cout * $charge['amt'] }}$
                                            </td>
                                            <td class="text-right charge-mois">{{ $chargeOb->mois * $charge['amt'] }}</td>
                                            <input type="hidden"
                                                class="charge-id"
                                                value="{{ $charge['id'] }}"><input type="hidden"
                                                class="charge-amt"
                                                value="{{ $charge['amt'] }}">
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width:70%">Total:</th>
                                        <th class="text-right"><span class="cout-total">{{ $price }}</span>$</th>
                                        <th class="text-right"><span class="mois-total">{{ $mois }}</span> Mois
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                        data-dismiss="modal"
                        class="btn blue-btn">Fermer</button>
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
                            action="{{ route('mandats.destroy', $mandat->id) }}">@csrf @method('DELETE')<button
                                type="submit"
                                class="btn btn-danger">Supprimer</button></form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
