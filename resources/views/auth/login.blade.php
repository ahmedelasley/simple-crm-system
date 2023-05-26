@extends('layouts.master-auth')

@section('content')

<div class="form-screen">
        <a href="#" class="spur-logo"><i class="fas fa-bolt"></i> <span>{{ config('app.name', 'Simple CRM System') }}</span></a>
        <div class="card account-dialog">
            <div class="card-header bg-primary text-white"> {{ __('Please sign in') }} </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
    
                    <div class="form-group">
                        <input type="email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">

                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <div class="account-dialog-actions">
                        <button type="submit" class="btn btn-primary">{{ __('Sign in') }}</button>
                        <a class="account-dialog-link" href="{{ route('register') }}">{{ __('Create a new account') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
