@extends('layouts.app')

@section('content')
@if ($user->getFirstMediaUrl('user-cover-images'))
    <div class="jumbotron hero-2" style="
                                        background-image: url({{$user->getFirstMediaUrl('user-cover-images')}});
                                        background-position: center;
                                        background-repeat: no-repeat;
                                        background-size: cover;
                                        height: 30vh;
                                        ">
        <div class="container">
            <h1 class="display-4 text-center my-5">{{isset($title) ? $title : ''}}</h1>
            <p class="display-5 text-center my-5">{{isset($subtitle) ? $subtitle : ''}}</p>
        </div>
    </div>

@else
    @include('inc.hero-2')

@endif

<div class="content container">

    <div class="row">
        <div class="col-md-10 mx-auto">
            <!-- Profile widget -->
            <div class="bg-white shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover">
                    <div class="media align-items-end profile-head">
                        <div class="profile mr-3">

                            @if ($user->getFirstMediaUrl('user-images', 'thumb'))
                                <img class="rounded mb-2 img-thumbnail" src="{{ $user->getFirstMediaUrl('user-images', 'thumb') }}" alt="{{$user->name}}">
                            @elseif($user->gender == 'female')
                                <img class="rounded mb-2 img-thumbnail" src="{{ asset('images/no-image-female.jpg') }}" alt="{{$user->name}}">
                            @else
                                <img class="rounded mb-2 img-thumbnail" src="{{ asset('images/no-image-male.jpg') }}" alt="{{$user->name}}">
                            @endif
                            @can('update', $user)
                                <a href="{{route('home.profile', $user)}}" class="btn btn-outline-dark btn-sm btn-block">{{__('text.edit')}}</a>
                            @endcan
                        </div>
                        <div class="media-body mb-4">
                            <h4 class="mt-0 mb-0">{{$user->name}}</h4>
                            <p class="small mb-0"><a href="{{route('profile', $user)}}"><i class="fa fa-user"></i> {{'@'.$user->slug}}</a></p>
                            <p class="small mb-0"> <i class="{{$user->city ? 'fas fa-map-marker-alt mr-2':''}}"></i>{{$user->city}}</p>
                            @if ($user->country)
                                <p><span class="flag-icon flag-icon-{{$user->country->code}}"></span> {{__('countries.'.$user->country->code)}}</p>
                            @endif
                            <p class="small mb-0"><i class="fa fa-link"></i> {{__('text.joined_date', ['joined'=>$user->created_at->diffForHumans()])}}</p>
                            @if ($user->role_id >=2)
                                <span class="badge badge-success">{{$user->role->name}}</span>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="bg-light p-4 d-flex justify-content-end text-center">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">{{$user->listing->count()}}</h5><small class="text-muted"> <i class="fas fa-list mr-1"></i>{{trans_choice('text.ad', 2)}}</small>
                        </li>
                        <li class="list-inline-item">
                            <h5 class="font-weight-bold mb-0 d-block">{{$user->hotlineMessage->count()}}</h5><small class="text-muted"> <i class="fas fa-fire mr-1"></i>{{trans_choice('text.hotline_message', 2)}}</small>
                        </li>
                    </ul>
                </div>
                @if ($user->about)
                    <div class="px-4 py-3">
                        <h5 class="mb-0">{{__('text.about_me')}}</h5>
                        <div class="p-4 rounded shadow-sm bg-light">
                            <p class="font-italic mb-0">{{$user->about}}</p>
                        </div>
                    </div>
                @endif

                @if ($user->listing->count() != 0)
                    <div class="py-4 px-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="mb-0">{{__('text.users_listings')}}</h5>
                        </div>
                        <div class="container">
                            @include('inc.listing.listings')
                        </div>
                    </div>
                @endif
                @if ($user->hotlineMessage->count() != 0)
                    <div class="py-4 px-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="mb-0">{{__('text.users_hotline_messages')}}</h5>
                        </div>
                        <div class="container">
                            @include('inc.hotline_messages')

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
