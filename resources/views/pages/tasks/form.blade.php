@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card spur-card">
            <div class="card-header d-flex flex-row justify-content-between">
                <div class="spur-card-icon">
                    <!-- <i class="fas fa-edit"></i> -->
                    <span class="spur-card-title">{{ isset($task) ? __('Edit Task') : __('Create Task')}}</span>
                </div>
            </div>
            <div class="card-body ">
                <form method="POST" action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store')  }}">
                    @csrf
                    @isset($task)
                        @method('put')
                    @endisset
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $task->name ?? old('name') }}" required autocomplete="name" placeholder="{{ __('Enter Name') }}" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">{{ __('Assigned Project') }}</label>
                        <select name="project_id" id="" class="form-control @error('project_id') is-invalid @enderror" required>
                            <option disabled selected>{{ __('Choose Project') }}</option>
                            @forelse ($projects as $key => $project)
                                @if(isset($task))
                                    <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? "selected" : ""  }} >{{ $project->name }}</option>
                                @else
                                    <option value="{{ $project->id }}" {{ old('project_id') == $key ? "selected" : ""   }} >{{ $project->name }}</option>
                                @endif
                            @empty
                            @endforelse
                        </select>
                        @error('project_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">{{ __('Description ') }}</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="50" rows="10" required autocomplete="description" placeholder="{{ __('Enter Description') }}">{{ $task->description ?? old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="deadline">{{ __('Deadline') }}</label>
                        <input type="date" id="deadline" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ $task->deadline ?? old('deadline') }}" required autocomplete="deadline" placeholder="{{ __('Enter Deadline') }}" autofocus>
                        @error('deadline')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="address">{{ __('Assigned User') }}</label>
                        <select name="user_id" id="" class="form-control @error('user_id') is-invalid @enderror" required>
                            <option disabled selected>{{ __('Choose User') }}</option>
                            @forelse ($users as $key => $user)
                                @if(isset($task))
                                    <option value="{{ $user->id }}" {{ $task->user_id == $user->id ? "selected" : ""  }} >{{ $user->name }}</option>
                                @else
                                    <option value="{{ $user->id }}" {{ old('user_id') == $key ? "selected" : ""   }} >{{ $user->name }}</option>
                                @endif
                            @empty
                            @endforelse
                        </select>
                        @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                </form>
            
            </div>

        </div>
    </div>

</div>
@endsection