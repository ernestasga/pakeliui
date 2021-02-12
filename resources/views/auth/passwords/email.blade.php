@extends('layouts.app')

@section('content')

<div class="container">
    <div id="logreg-forms">
        <div class="card-header">{{ __('auth.reset_password') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">{{__('auth.email')}}</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{__('auth.email')}}" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-envelope"></i> {{__('auth.send_password_reset_link')}}</button>
        </form>
    </div>
</div>
@endsection
