@extends('layouts.app')
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v9.0&appId=1755858911398895&autoLogAppEvents=1" nonce="4QAWG8JZ"></script>
@section('content')
<div class="jumbotron hero-2">
    <div class="container">
        <h1 class="display-4 text-center my-5">{{__('text.become_vip_now')}}</h1>
    </div>
</div>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row d-flex justify-content-center mb-1">
                <i class="fa fa-crown fa-2x"></i>
            </div>
            <h4 class="text-center">{{__('text.how_to_get_vip')}}</h4>
        </div>
        <div class="card-body">
            <p class="text-center">{{__('text.vip_instructions')}}</p>
            <div class="fb-page d-flex justify-content-center" data-href="{{config('social.facebook_page_link')}}"
                data-tabs="timeline" data-width="" data-height="" data-small-header="false"
                    data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="{{config('social.facebook_page_link')}}" class="fb-xfbml-parse-ignore">
                            <a href="{{config('social.facebook_page_link')}}">{{config('social.facebook_page_name')}}</a>
                        </blockquote>
            </div>
        </div>
    </div>
</div>

@endsection
