@extends('layouts.app')

@section('content')
<div class="container">
    <div id="logreg-forms">
        <form class="form-signin" method="POST" action="{{ route('login') }}">
            @csrf
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> {{__('auth.login')}}</h1>
            <div class="social-login d-flex justify-content-center">
                <a href="{{route('login.facebook')}}"><button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> {{__('auth.signin_facebook')}}</span> </button></a>
            </div>
            <div class="social-login d-flex justify-content-center">
                <a href="{{route('login.google')}}"><button class="btn google-btn social-btn" type="button"><span><i class="fab fa-google-plus-g"></i> {{__('auth.signin_google+')}}</span> </button></a>
            </div>
            <p style="text-align:center"> {{__('text.or')}}  </p>
            <input id="inputEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{__('auth.email')}}" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <input id="inputPassword" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{__('auth.password')}}" name="password" required autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="form-group row mt-2">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('auth.remember') }}
                        </label>
                    </div>
                </div>
            </div>
            <button class="btn btn-success btn-block" type="submit"><i class="fas fa-sign-in-alt"></i> {{__('auth.login')}}</button>

            <a href="#" id="forgot_pswd">{{__('auth.forgot_password')}}</a>
            <hr>
            <!-- <p>Don't have an account!</p>  -->
            <button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> {{__('auth.register')}}</button>
            </form>

            <form  method="POST" action="{{ route('password.email') }}" class="form-reset">
                @csrf
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="{{__('auth.email')}}" required autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <button class="btn btn-primary btn-block" type="submit">{{__('auth.reset_password')}}</button>
                <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> {{__('text.back')}}</a>
            </form>

            <form method="POST" action="{{ route('register') }}" class="form-signup">
                @csrf
                <div class="social-login">
                    <a href="{{route('login.facebook')}}"><button class="btn facebook-btn social-btn" type="button"><span><i class="fab fa-facebook-f"></i> {{__('auth.signin_facebook')}}</span> </button></a>
                </div>
                <div class="social-login">
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
                <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> {{__('text.back')}}</a>
            </form>
            <br>

    </div>

</div>

@endsection
