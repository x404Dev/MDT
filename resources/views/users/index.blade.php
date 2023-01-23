@extends('layouts.app')

@section('content')
    <div class="card shadow" style="height: 80vh;">
        <div class=" card-header py-3 ">
            <p class="text-primary m-0 font-weight-bold ">Users</p>
        </div>
        <div class="card-body" style="overflow-y:scroll;">
            <div class="row ">
                <div class="col-md-6 text-nowrap ">
                    <form class="ml-auto" action="{{ route('registernumber.store') }}" method="POST">
                        @csrf
                        <button class="btn blue-btn btn-sm d-none d-sm-inline-block"
                            type="submit"><i class="far fa-plus-square fa-sm"></i> New Registry Key</button>
                    </form>

                </div>
            </div>
            <div class="table-responsive table mt-2 " id="dataTable " role="grid " aria-describedby="dataTable_info ">
                <table class="table my-0 " id="dataTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th class="text-center">User #</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td style="width: 50%">{{ $user->name }}<a></td>
                                <td class="text-center">{{ $user->id }}</a></td>
                                <td class="text-right">
                                    <div class="row">
                                        <form class="ml-auto" action="{{ route('users.update', $user->id) }}"
                                            method="POST">
                                            <input name="_method" type="hidden" value="PUT">
                                            @csrf
                                            @if (auth()->user()->id === $user->id)
                                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip"
                                                    data-delay="700" data-offset="-25"
                                                    title="You cannot change your own role!">
                                            @endif
                                            @if ($user->role_id === '1')
                                                <button @if (auth()->user()->id === $user->id) disabled style="pointer-events: none;" @endif type="submit" class=" btn grey-btn btn-sm   
                                                          @if (auth()->user()->id ===
                                                    $user->id) disabled @endif"><i class="fas fa-key"></i>
                                                    Set User</button>
                                            @else
                                                <button @if (auth()->user()->id === $user->id) disabled style="pointer-events: none;" @endif type="submit" class=" btn grey-btn btn-sm   
                                                              @if (auth()->user()->id ===
                                                    $user->id) disabled @endif"><i class="fas fa-key"></i>
                                                    Set Admin</button>
                                            @endif
                                            @if (auth()->user()->id === $user->id)
                                                </span>
                                            @endif
                                        </form>
                                        <form class="ml-1" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            <input name="_method" type="hidden" value="DELETE">
                                            @csrf
                                            @if (auth()->user()->id === $user->id)
                                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip"
                                                    data-delay="700" data-offset="-25"
                                                    title="You can't delete yourself!">
                                            @endif
                                            <button @if (auth()->user()->id === $user->id) disabled style="pointer-events: none;" @endif type="submit" class=" btn blue-btn btn-sm   
                                                          @if (auth()->user()->id ===
                                                $user->id) disabled @endif"><i class="fas fa-power-off"></i>
                                                Deactivate</button>
                                            @if (auth()->user()->id === $user->id)
                                                </span>
                                            @endif
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th class="text-center">User #</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
