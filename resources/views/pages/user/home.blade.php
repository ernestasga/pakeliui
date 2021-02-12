@extends('layouts.app')

@section('content')
@if ($user->getFirstMediaUrl('uploaded-images'))
    <div class="jumbotron hero-2" style="
                                        background-image: url({{$user->getFirstMediaUrl('uploaded-images')}});
                                        background-position: center;
                                        background-repeat: no-repeat;
                                        background-size: cover;
                                        height: 30vh;
                                        ">
        <div class="container">
            <h1 class="display-4 text-center">{{$user->name}}</h1>
        </div>
    </div>
@else
    <div class="jumbotron hero-2">
        <div class="container">
            <h1 class="display-4 text-center">{{$user->name}}</h1>
        </div>
    </div>
@endif<div class="container">
    <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4">
            @include('inc.home_sidebar')
        </div>
        <div class="col-sm-8 col-md-8 col-lg-8">
            <h2 class="text-center">{{__('text.hello_user', ['user'=>$user->name])}}</h2>
            @if ($user->isVip())
                <div class="card-header d-flex justify-content-center">
                    <i class="fa fa-crown fa-2x"></i> <h5>{{__('text.your_role', ['role'=>$user->role->name])}} {{$user->subscription ? __('text.until', ['date'=>$user->subscription->expires_at->formatLocalized(config('app.date_format'))]) : ''}}</h5>
                </div>
            @else
                <div class="card-header d-flex justify-content-center">
                    @include('inc.become_vip_now')
                </div>
            @endif
            <div class="row d-flex justify-content-center mt-3">
                <div class="col-lg-2 col-sm-6">
                  <div class="circle-tile ">
                    <a href="#"><div class="circle-tile-heading dark-blue"><i class="fa fa-list fa-fw fa-3x"></i></div></a>
                    <div class="circle-tile-content dark-blue">
                      <div class="circle-tile-description text-faded"> {{__('page.my_listings')}}</div>
                      <div class="circle-tile-number text-faded ">{{$user->listing->count()}}</div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-2 col-sm-6">
                  <div class="circle-tile ">
                    <a href="#"><div class="circle-tile-heading red"><i class="fa fa-fire fa-fw fa-3x"></i></div></a>
                    <div class="circle-tile-content red">
                      <div class="circle-tile-description text-faded"> {{__('text.hotline')}} </div>
                      <div class="circle-tile-number text-faded ">{{$user->hotlineMessage->count()}}</div>
                    </div>
                  </div>
                </div>
              </div>
              @include('inc.hotline_messages')
              @include('inc.listing.listings')
        </div>
    </div>

</div>
@endsection
