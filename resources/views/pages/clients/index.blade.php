@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12 col-md-12">
        <div class="card spur-card">
            <div class="card-header d-flex flex-row justify-content-between">
                    <div class="spur-card-icon">
                        <i class="fas fa-table"></i>
                        <span class="spur-card-title">{{ __('Clients') }}</span>
                    </div>
                    <div class="spur-card-title">
                        <a href="{{ route('clients.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
                    </div>

            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">No. Projects</th>
                                <th scope="col">Username</th>
                                <th scope="col">Controls</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clients as $client)
                                <tr>
                                    <th class="bg-gray-100" scope="row">{{ $clients->firstItem()+$loop->index }}</th>
                                    <th>
                                        <img src="{{ URL::asset($client->image) }}" class="img-fluid img-thumbnail w-50 h-50" alt="" srcset="">
                                    </th>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->phone }}</td>
                                    <td>{{ $client->address }}</td>
                                    <td>{{ $client->projects->count() }}</td>
                                    <td>{{ $client->user->name }}</td>
                                    <td>
                                        <div class="d-flex flex-row justify-content-center border-0">
                                            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ route('clients.archive', $client->id) }}" class="btn btn-warning btn-sm mx-1"><i class="fas fa-archive"></i> Archive</a>

                                            <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mx-1"><i class="fas fa-times"></i> Destroy</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="9">{{ __('No Data Yat !') }}</td>
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
                            {{ $clients->withQueryString()->onEachSide(0)->links() }} 
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection