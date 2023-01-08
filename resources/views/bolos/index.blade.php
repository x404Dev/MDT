@extends('layouts.app')

@section('styles')
    <style>
        .header {
            display: flex;
            flex-direction: row;
        }

        .header div {
            flex: 1;
        }

        .page-title {
            display: inline;
        }

        .page-subtitle {
            display: inline;
        }

        .page-options {
            display: inline;
            float: right;
        }
    </style>
@endsection

@section('content')
    @if (isset($search))
        <div class="alert alert-primary">
            Vous avez un élément de recherche actif... <a class="alert-link"
                href="{{ route('bolos.index') }}">Cliquez-ici</a> pour l'enlever!
        </div>
    @endif
    <div class="">
        <div class="row my-2">
            <div class="col-md-6 text-nowrap ">
                <a class="blue-btn btn d-none d-sm-inline-block" href="{{ route('bolos.create') }}"
                    role="button"><i class="far fa-plus-square fa-sm"></i> Ajouter</a>
    
            </div>
            <div class="col-md-6 ">
                <div class="text-md-right dataTables_filter "
                    id="dataTable_filter ">
                    <form action="{{ route('bolos.index') }}"
                        method="get">
                        <div class="input-group">

                            <input name="search"
                                required
                                type="search"
                                class="form-control form-control"
                                style="border-top-left-radius: 50px; border-bottom-left-radius: 50px; padding-left: 15px"
                                aria-controls="dataTable "
                                @if (isset($search)) value="{{ $search }}" @endif
                                placeholder="Search ">
                            <div class="input-group-append">
                                <button type="submit"
                                    class="btn btn-outline-primary btn-sm px-5"
                                    style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;"><i
                                        class="fas fa-search"
                                        style="margin-right: 5px"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Type</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Action</th>
                    <th scope="col">Création</th>
                </tr>
            </thead>
            <tbody>
                @if (sizeof($bolos) > 0)
                    @foreach ($bolos as $bolo)
                        <tr>
                            <th style="width: 1%"
                                scope="row">{{ $bolo->id }}</th>
                            </td>
                            <td style="width: 1%; text-align: center; color: #006aff">@if($bolo->type == 'arme') <i class="fas fa-exclamation-circle"></i> @else <i class="fas fa-car"></i> @endif</td>
                            <td><a href="{{ route('bolos.show', $bolo->id) }}">{{ $bolo->nom }}</a></td>

                            <td style="width: 1%">
                                <div style="white-space: nowrap"><a href="{{ route('bolos.show', $bolo->id) }}"
                                        class="btn grey-btn"
                                        style="white-space: nowrap;"><i class="fas fa-eye"></i> Voir</a></div>
                            </td>
                            <td style="width: 1%; white-space: nowrap">{{ $bolo->created_at }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>Aucun BOLO à montrer</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    @if (gettype($bolos) != 'array')
        {{ $bolos->links() }}
    @endif
@endsection
