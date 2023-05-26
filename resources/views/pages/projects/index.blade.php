@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card spur-card">
            <div class="card-header d-flex flex-row justify-content-between">
                    <div class="spur-card-icon">
                        <i class="fas fa-table"></i>
                        <span class="spur-card-title">{{ __('Projects') }}</span>
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    </div>
                    <div class="spur-card-title">
                        <a href="{{ route('projects.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
                    </div>

            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Client</th>
                                <th scope="col">Username</th>
                                <th scope="col">Status</th>
                                <th scope="col">Controls</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projects as $project)
                                <tr>
                                    <th class="bg-gray-100" scope="row">{{ $projects->firstItem()+$loop->index }}</th>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->description }}</td>
                                    <td>{{ $project->deadline }}</td>
                                    <td>{{ $project->client->name }}</td>
                                    <td>{{ $project->user->name }}</td>
                                    <td>
                                        @if( $project->status == 1 )
                                            <span class="badge bg-success rounded-pill p-2 text-white d-flex">{{ __('Open') }}</span>
                                        @elseif ( $project->status == 0 )
                                            <span class="badge bg-danger rounded-pill p-2 text-white d-flex">{{ __('Close') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row justify-content-center border-0">
                                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-success btn-sm mx-1"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ route('projects.archive', $project->id) }}" class="btn btn-warning btn-sm mx-1"><i class="fas fa-archive"></i> Archive</a>

                                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm mx-1"><i class="fas fa-times"></i> Destroy</button>
                                            </form>
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
                            {{ $projects->withQueryString()->onEachSide(0)->links() }} 
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection