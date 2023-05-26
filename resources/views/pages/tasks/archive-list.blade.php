@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card spur-card">
            <div class="card-header d-flex flex-row justify-content-between">
                    <div class="spur-card-icon">
                        <i class="fas fa-table"></i>
                        <span class="spur-card-title">{{ __('Tasks') }}</span>
                        @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    </div>
                    <div class="spur-card-title">
                        <a href="{{ route('tasks.restoreAll') }}" class="btn btn-primary"><i class="fas fa-undo"></i> Restore All</a>
                    </div>

            </div>
            <div class="card-body ">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Project</th>
                                <th scope="col">Description</th>
                                <th scope="col">Deadline</th>
                                <th scope="col">Completed</th>
                                <th scope="col">Username</th>
                                <th scope="col">Controls</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task)
                                <tr>
                                    <th class="bg-gray-100" scope="row">{{ $tasks->firstItem()+$loop->index }}</th>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->project->name }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ $task->deadline }}</td>
                                    <td>
                                        @if( $task->completed_at != NULL )
                                            <span class="badge bg-success rounded-pill p-2 text-white d-flex">{{ __('Completed') }}</span>
                                        @elseif ( $task->completed_at == NULL )
                                            <span class="badge bg-danger rounded-pill p-2 text-white d-flex">{{ __('No Completed') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $task->user->name }}</td>

                                    <td>
                                        <div class="d-flex flex-row justify-content-center border-0">
                                            <a href="{{ route('tasks.restore', ['id' => $task->id]) }}" class="btn btn-success btn-sm mx-1"><i class="fas fa-undo"></i> Restore</a>
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
                            {{ $tasks->withQueryString()->onEachSide(0)->links() }} 
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection