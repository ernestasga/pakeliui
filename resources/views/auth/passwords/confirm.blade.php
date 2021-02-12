@extends('layouts.app')

@section('content')

<div class="container">
    <div id="logreg-forms">
        <div class="card-header">{{ __('auth.confirm_password') }}</div>
        <div class="card-body">
            <p class="text-center">{{ __('auth.confirm_before_continue') }}</p>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="form-group">
                    <label for="password">{{__('auth.password')}}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{__('auth.password')}}" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-key"></i> {{__('auth.confirm_password')}}</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('auth.forgot_password') }}
                    </a>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
