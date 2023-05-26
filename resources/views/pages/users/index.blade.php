@extends('layouts.master')

@section('content')
<div class="row dash-row">
    <div class="col-12 col-md-12">
        <div class="card spur-card">
            <div class="card-header d-flex flex-row justify-content-between">
                    <div class="spur-card-icon">
                        <i class="fas fa-table"></i>
                        <span class="spur-card-title">{{ __('Users') }}</span>
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    </div>
                    <div class="spur-card-title">
                        <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create</a>
                    </div>

            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">No. Clients</th>
                                <th scope="col">No. Projects</th>
                                <th scope="col">No. Tasks</th>
                                <th scope="col">Controls</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <th class="bg-gray-100" scope="row">{{ $users->firstItem()+$loop->index }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->clients->count() }}</td>
                                    <td>{{ $user->projects->count() }}</td>
                                    <td>{{ $user->tasks->count() }}</td>
                                    <td>
                                        <div class="d-flex flex-row justify-content-center border-0">
                                            @if(!($user->id == Auth::id() ))
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mx-1"><i class="fas fa-times"></i> Destroy</button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="8">{{ __('No Data Yat !') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex flex-row justify-content-around">
                    <div class="">
                        <ul class="pagination  pagination-circled text-center">
                            {{ $users->withQueryString()->onEachSide(0)->links() }} 
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection