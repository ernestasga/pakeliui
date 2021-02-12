@extends('layouts.app')

@section('content')
<div class="container">
    <div id="logreg-forms">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="social-login d-flex justify-content-center">
                    <a href="{{route('login.facebook')}}"><button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> {{__('auth.signin_facebook')}}</span> </button></a>
                </div>
                <div class="social-login d-flex justify-content-center">
                    <a href="{{route('login.google')}}"><button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> {{__('auth.signin_google+')}}</span> </button></a>
                </div>
                <p style="text-align:center">{{__("text.or")}}</p>

                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{__('auth.name')}}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{__('auth.email')}}" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <select class="form-control @error('country') is-invalid @enderror" name="country" required>
                    @foreach (\App\Models\Country::all() as $i=>$country)
                        @if ($i==3)
                            <option disabled></option>
                        @endif
                        <option value="{{$i+1}}">{{__('countries.'.$country->code)}}</option>
                    @endforeach
                </select>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{__('auth.password')}}" name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{__('auth.confirm_password')}}" required autocomplete="new-password">
                <button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> {{__('auth.register')}}</button>
            </form>
            <p class="text-center">{{__('text.or')}}</p>

            <div class="row m-3 pb-2 align-items-center">
                <a href="{{route('login')}}"><button class="btn btn-success" type="button"><i class="fas fa-sign-in-alt"></i> {{__('auth.login')}}</button></a>
            </div>

    </div>

</div>

@endsection
