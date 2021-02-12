@extends('layouts.app')

@section('content')

<div class="container">
    <div id="logreg-forms">
        <div class="card-header">{{ __('auth.reset_password') }}</div>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{__('auth.email')}}" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{__('auth.password')}}" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{__('auth.confirm_password')}}" required autocomplete="new-password">
            <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-key"></i> {{__('auth.reset_password')}}</button>
        </form>
    </div>

</div>

@endsection
