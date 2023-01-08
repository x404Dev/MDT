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
                        href="{{ route('mandats.index') }}">Cliquez-ici</a> pour l'enlever!
                </div>
            @endif
<div class="">
    <div class="row my-2">
        <div class="col-md-6 text-nowrap ">

        </div>
        <div class="col-md-6 ">
            <div class="text-md-right dataTables_filter " id="dataTable_filter ">
                <form action="{{ route('mandats.index') }}" method="get">
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
            <th scope="col">Raison</th>
            <th style="white-space: nowrap" scope="col">Valide</th>
            <th scope="col">Action</th>
            <th scope="col">Création</th>
            <th scope="col">Expiration</th>
          </tr>
        </thead>
        <tbody>
            @if(sizeof($mandats) > 0)
            @foreach($mandats as $mandat)
          <tr>
            <th style="width: 1%" scope="row">{{ $mandat->id }}</th>
            <td><a href="{{ route('dossiers.show', $mandat->dossier->id) }}">{{ $mandat->dossier->nom }}</a></td>
            <td><a href="{{ route('mandats.show', $mandat->id) }}">{{ $mandat->titre }}</a></td>
            <td style="width: 1%" class="text-center">@if (!$mandat->created_at->addDays(14)->isPast())<i style="color: rgb(40, 201, 0);" class="fas fa-check"></i>@else<i style="color: rgb(255, 57, 57);" class="fas fa-times"></i>@endif</td>
            
            <td style="width: 1%"><div style="white-space: nowrap"><a href="{{ route('mandats.show', $mandat->id) }}" class="btn grey-btn" style="white-space: nowrap;"><i class="fas fa-eye"></i> Voir</a></div>
            </td>
            <td style="width: 1%; white-space: nowrap">{{ $mandat->created_at }}</td>
            <td style="width: 1%; white-space: nowrap">{{ $mandat->created_at->addDays(14) }}</td>
          </tr>
          @endforeach
          @else
          <tr>
            <td>Aucun mandats à montrer</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          @endif
        </tbody>
      </table>
</div>
@if(gettype($mandats) != 'array')
{{ $mandats->links() }}
@endif
@endsection