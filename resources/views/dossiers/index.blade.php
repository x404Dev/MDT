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
                        href="{{ route('dossiers.index') }}">Cliquez-ici</a> pour l'enlever!
                </div>
            @endif
<div class="">
    <div class="row my-2">
        <div class="col-md-6 text-nowrap ">
            <a class="blue-btn btn d-none d-sm-inline-block" href="{{ route('dossiers.create') }}"
                role="button"><i class="far fa-plus-square fa-sm"></i> New</a>

        </div>
        <div class="col-md-6 ">
            <div class="text-md-right dataTables_filter " id="dataTable_filter ">
                <form action="{{ route('dossiers.index') }}" method="get">
                    <div class="input-group">

                        <input name="search" required type="search" class="form-control form-control"
                            style="border-top-left-radius: 50px; border-bottom-left-radius: 50px; padding-left: 15px"
                            aria-controls="dataTable " @if (isset($search)) value="{{ $search }}" @endif  placeholder="Search ">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-primary btn-sm px-5"
                                style="border-top-right-radius: 50px; border-bottom-right-radius: 50px;"><i
                                    class="fas fa-search" style="margin-right: 5px"></i></button>
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
            <th scope="col">Nom</th>
            <th style="white-space: nowrap" scope="col">Sous Mandat</th>
            <th scope="col">Action</th>
            <th scope="col">Création</th>
            <th scope="col">Modification</th>
          </tr>
        </thead>
        <tbody>
            @if(sizeof($dossiers) > 0)
            @foreach($dossiers as $dossier)
          <tr>
            <th style="width: 1%" scope="row">{{ $dossier->id }}</th>
            <td><a href="{{ route('dossiers.show', $dossier->id) }}">{{ $dossier->nom }}</a></td>
            <td style="width: 1%" class="text-center">@if($dossier->id == 1)<i style="color: rgb(40, 201, 0);" class="fas fa-check"></i>@else<i style="color: rgb(255, 57, 57);" class="fas fa-times"></i>@endif</td>
            <td style="width: 1%"><div style="white-space: nowrap"><a href="{{ route('dossiers.show', $dossier->id) }}" class="btn grey-btn" style="white-space: nowrap;"><i class="fas fa-eye"></i> Voir</a><a class="btn blue-btn" style="white-space: nowrap;"><i class="fas fa-file-alt"></i> Nouveau Rapport</a></div>
            </td>
            <td style="width: 1%; white-space: nowrap">{{ $dossier->created_at }}</td>
            <td style="width: 1%; white-space: nowrap">{{ $dossier->updated_at }}</td>
          </tr>
          @endforeach
          @else
          <tr>
            <td>Aucun dossier à montrer</td>
          </tr>
          @endif
        </tbody>
      </table>
</div>
@if(gettype($dossiers) != 'array')
{{ $dossiers->links() }}
@endif
@endsection