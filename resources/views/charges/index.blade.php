@extends('layouts.app')

@section('content')
    <div class="card shadow" style="height: 80vh;">
        <div class=" card-header py-3 ">
            <p class="text-primary m-0 font-weight-bold ">Charges</p>
        </div>
        <div class="card-body" style="overflow-y:scroll;">
            <div class="row ">
                <div class="col-md-6 text-nowrap ">
                    <a class="btn blue-btn btn-sm d-none d-sm-inline-block" href="{{ route('charges.create') }}"
                        role="button"><i class="far fa-plus-square fa-sm"></i> Ajouter</a>

                </div>
            </div>
            <div class="table-responsive table mt-2 " id="dataTable " role="grid " aria-describedby="dataTable_info ">
                <table class="table my-0 " id="dataTable">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th class="text-center">Coût</th>
                            <th class="text-center">Mois</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($charges as $charge)
                            <tr>
                                <td style="width: 65%" class="hoveru"><a href="{{ route('charges.show', $charge->id) }}">
                                        {{ $charge->nom }}</a></td>
                                <td class="text-center" class="hoveru">{{ $charge->cout }}$</td>
                                <td class="text-center" class="hoveru">{{ $charge->mois }}</td>
                                <td class="text-right">
                                    <a class="btn grey-btn btn-sm" href="{{ route('charges.show', $charge->id) }}"><i
                                        class="fas fa-pencil-alt"></i> Modifier</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nom</th>
                            <th class="text-center">Coût</th>
                            <th class="text-center">Mois</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            {{ $charges->links() }}
        </div>
    </div>
@endsection
