@extends('layouts.app')

@section('content')
<div class="jumbotron hero-2">
    <div class="container">
        <h1 class="display-4 text-center my-5">{{__('page.hotline')}}</h1>
        <p class="display-5 text-center my-5"></p>
    </div>
</div>
<div class="content container">
    @auth
        <div class="container">
            <form action="{{route('hotline.store')}}" method="post">
                @csrf
                @method('POST')
                    <div class="col-12">
                        <textarea class="form-control text-center @error('message') is-invalid @enderror" placeholder="..." name="message" required></textarea>
                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="vip" value="" {{Auth::user()->can('customize', \App\Models\HotlineMessage::class) ? '' : 'disabled'}}>
                            <label class="form-check-label" for="vip">{{__('text.custom_default')}}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="vip" value="hotline-vip-1" {{Auth::user()->can('customize', \App\Models\HotlineMessage::class) ? '' : 'disabled'}}>
                            <label class="form-check-label" for="vip">{{__('text.custom_vip_1')}}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="vip" value="hotline-vip-2" {{Auth::user()->can('customize', \App\Models\HotlineMessage::class) ? '' : 'disabled'}}>
                            <label class="form-check-label" for="vip">{{__('text.custom_vip_2')}}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="vip" value="hotline-vip-3" {{Auth::user()->can('customize', \App\Models\HotlineMessage::class) ? '' : 'disabled'}}>
                            <label class="form-check-label" for="vip">{{__('text.custom_vip_3')}}</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="vip" value="hotline-vip-4" {{Auth::user()->can('customize', \App\Models\HotlineMessage::class) ? '' : 'disabled'}}>
                            <label class="form-check-label" for="vip">{{__('text.custom_vip_4')}}</label>
                        </div>
                        @cannot('customize', \App\Models\HotlineMessage::class)
                            @include('inc.become_vip_now')
                        @endcannot

                    </div>
                    <div class="col mt-4 mb-4">
                        <button type="submit" class="btn btn-success">{{__('text.post_message')}}</button>
                    </div>
            </form>
        </div>
    @else
        <div class="container text-center mb-4">
            <a href="{{route('login')}}"><button class="btn btn-success">{{__('text.login_to_chat')}}</button></a>
        </div>
    @endauth
        @include('inc.hotline_messages')
</div>

@endsection
