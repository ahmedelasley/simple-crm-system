@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card spur-card">
            <div class="card-header d-flex flex-row justify-content-between">
                <div class="spur-card-icon">
                    <!-- <i class="fas fa-edit"></i> -->
                    <span class="spur-card-title">{{ isset($project) ? __('Edit Project') : __('Create Project')}}</span>
                </div>
            </div>
            <div class="card-body ">
                <form method="POST" action="{{ isset($project) ? route('projects.update', $project->id) : route('projects.store')  }}">
                    @csrf
                    @isset($project)
                        @method('put')
                    @endisset
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $project->title ?? old('title') }}" required autocomplete="title" placeholder="{{ __('Enter Name') }}" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description ') }}</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="50" rows="10" required autocomplete="description" placeholder="{{ __('Enter Description') }}">{{ $project->description ?? old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="deadline">{{ __('Deadline') }}</label>
                        <input type="date" id="deadline" class="form-control @error('deadline') is-invalid @enderror" name="deadline" value="{{ $project->deadline ?? old('deadline') }}" required autocomplete="deadline" placeholder="{{ __('Enter Deadline') }}" autofocus>
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
                                @if(isset($project))
                                    <option value="{{ $user->id }}" {{ $project->user_id == $user->id ? "selected" : ""  }} >{{ $user->name }}</option>
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

                    <div class="form-group">
                        <label for="address">{{ __('Assigned Client') }}</label>
                        <select name="client_id" id="" class="form-control @error('client_id') is-invalid @enderror" required>
                            <option disabled selected>{{ __('Choose Client') }}</option>
                            @forelse ($clients as $key => $client)
                                @if(isset($project))
                                    <option value="{{ $client->id }}" {{ $project->client_id == $client->id ? "selected" : ""  }} >{{ $client->name }}</option>
                                @else
                                    <option value="{{ $client->id }}" {{ old('client_id') == $key ? "selected" : ""   }} >{{ $client->name }}</option>
                                @endif
                            @empty
                            @endforelse
                        </select>
                        @error('client_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">{{ __('Status') }}</label>
                        <select name="status" id="" class="form-control @error('status') is-invalid @enderror" required>
                                <option disabled selected>{{ __('Choose Status') }}</option>
                                @if(isset($project))
                                    <option value="0" {{ $project->status == 0 ? "selected" : ""  }} >{{ __('Close') }}</option>
                                    <option value="1" {{ $project->status == 1 ? "selected" : ""  }} >{{ __('Open') }}</option>
                                @else
                                    <option value="0" {{ old('status') == 0 ? "selected" : ""   }} >{{ __('Close') }}</option>
                                    <option value="1" {{ old('status') == 1 ? "selected" : ""   }} >{{ __('Open') }}</option>
                                    
                                @endif
                        </select>
                        @error('status')
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