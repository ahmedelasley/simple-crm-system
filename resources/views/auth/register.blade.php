

@extends('layouts.master-auth')

@section('content')

<div class="form-screen">
        <a href="#" class="spur-logo"><i class="fas fa-bolt"></i> <span>{{ config('app.name', 'Simple CRM System') }}</span></a>
        <div class="card account-dialog">
            <div class="card-header bg-primary text-white"> {{ __('Create an account') }} </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
    

                    <div class="form-group">
                        <input type="text"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="{{ __('Enter Name') }}" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="email"  class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Enter Email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Enter Password') }}">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Enter Confirm Password') }}">
                    </div>
                    






                    <div class="account-dialog-actions">
                        <button type="submit" class="btn btn-primary">{{ __('Sign up') }}</button>
                        <a class="account-dialog-link" href="{{ route('login') }}">{{ __('Already have an account?') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
