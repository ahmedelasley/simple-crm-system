@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card spur-card">
            <div class="card-header d-flex flex-row justify-content-between">
                <div class="spur-card-icon">
                    <!-- <i class="fas fa-edit"></i> -->
                    <span class="spur-card-title">{{ isset($user) ? __('Edit User') : __('Add User')}}</span>
                </div>
            </div>
            <div class="card-body ">
                <form method="POST" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store')  }}">
                    @csrf
                    @isset($user)
                        @method('put')
                    @endisset
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name ?? old('name') }}"  autocomplete="name" placeholder="{{ __('Enter Name') }}" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">{{ __('Email ') }}</label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email ?? old('email') }}"  autocomplete="email" placeholder="{{ __('Enter Email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">{{ __('Phone') }}</label>
                        <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone ?? old('phone') }}"  autocomplete="phone" placeholder="{{ __('Enter Phone') }}" autofocus>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="{{ __('Enter Password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('Confirm Password') }}</label>
                        <input type="password" id="confirm-password" class="form-control" name="confirm-password"  autocomplete="new-password" placeholder="{{ __('Enter Confirm Password') }}">
                        @error('confirm-password')
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