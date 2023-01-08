@extends('layouts.app')

@section('content')
    @php

    $mandats = App\Models\Mandat::latest()->take(5)->get();
    $rapports = App\Models\Rapport::latest()->take(5)->get();

    @endphp
    <div class="row">
        <div class="col-4">
            <div class="p-2">
                <div class="card shadow" style="height: 80vh;">
                    <div class=" card-header py-3 ">
                        <p class="text-primary m-0 font-weight-bold ">Mandats récents</p>
                    </div>
                    <div class="card-body" style="overflow-y:scroll;">
                        <div class="table-responsive table mt-2 " id="dataTable " role="grid "
                            aria-describedby="dataTable_info ">
                            <table class="table my-0 " id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th style="white-space: nowrap" class="text-center">Mandat #</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mandats as $mandat)
                                        <tr>
                                            <td style="width: 50%" class="hoveru"><a
                                                    href="{{ route('mandats.show', ['mandat' => $mandat->id]) }}">{{ $mandat->dossier->nom }}<a>
                                            </td>
                                            <td class="text-center hoveru"><a
                                                    href="{{ route('mandats.show', ['mandat' => $mandat->id]) }}">{{ $mandat->id }}</a>
                                            </td>
                                            <td class="text-center"><a
                                                    href="{{ route('mandats.show', ['mandat' => $mandat->id]) }}"
                                                    style="white-space: nowrap" class=" btn grey-btn btn-sm mx-1"><i class="far fa-eye"></i>
                                                    Voir</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">Mandat #</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="p-2">
                <div class="card shadow" style="height: 80vh;">
                    <div class=" card-header py-3 ">
                        <p class="text-primary m-0 font-weight-bold ">Recent Reports</p>
                    </div>
                    <div class="card-body" style="overflow-y:scroll;">
                        <div class="table-responsive table mt-2 " id="dataTable " role="grid "
                            aria-describedby="dataTable_info ">
                            <table class="table my-0 " id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th style="white-space: nowrap" class="text-center">Report #</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rapports as $rapport) 
                                        <tr>
                                            <td style="width: 50%" class="hoveru"><a
                                                    href="{{ route('rapports.show', [$rapport->dossier_id, $rapport->id]) }}">{{ $rapport->titre }}<a>
                                            </td>
                                            <td class="text-center hoveru"><a
                                                    href="{{ route('rapports.show', [$rapport->dossier_id, $rapport->id]) }}">{{ $rapport->id }}</a>
                                            </td>
                                            <td class="text-center"><a
                                                    href="{{ route('rapports.show', [$rapport->dossier_id, $rapport->id]) }}"
                                                    style="white-space: nowrap" class=" btn grey-btn btn-sm mx-1"><i class="far fa-eye"></i>
                                                    View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">Report #</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
