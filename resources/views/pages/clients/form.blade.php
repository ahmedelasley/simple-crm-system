@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card spur-card">
            <div class="card-header d-flex flex-row justify-content-between">
                <div class="spur-card-icon">
                    <!-- <i class="fas fa-edit"></i> -->
                    <span class="spur-card-title">{{ isset($client) ? __('Edit Client') : __('Add Client')}}</span>
                </div>
            </div>
            <div class="card-body ">
                <form method="POST" action="{{ isset($client) ? route('clients.update', $client->id) : route('clients.store')  }}"  enctype="multipart/form-data">
                    @csrf
                    @isset($client)
                        @method('put')
                    @endisset
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $client->name ?? old('name') }}"  autocomplete="name" placeholder="{{ __('Enter Name') }}" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('Email ') }}</label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $client->email ?? old('email') }}"  autocomplete="email" placeholder="{{ __('Enter Email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ __('Phone') }}</label>
                        <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $client->phone ?? old('phone') }}"  autocomplete="phone" placeholder="{{ __('Enter Phone') }}" autofocus>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('Address') }}</label>
                        <input type="text" id="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $client->address ?? old('address') }}"  autocomplete="address" placeholder="{{ __('Enter Address') }}">
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">{{ __('Image') }}</label>
                        <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ URL::asset($client->image) ?? old('image') }}"  autocomplete="address" placeholder="{{ __('Image') }}">
                        @error('image')
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