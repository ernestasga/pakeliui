@extends('layouts.app')

<!-- Facebook -->
@if (config('app.fb_share_enabled'))
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v9.0&appId=386992006188970&autoLogAppEvents=1" nonce="tJZ8JreG"></script>
@endif
@section('content')
@if ($listing->getFirstMediaUrl('uploaded-images'))
    <div class="jumbotron hero-2" style="
                                        background-image: url({{$listing->getFirstMediaUrl('uploaded-images')}});
                                        background-position: center;
                                        background-repeat: no-repeat;
                                        background-size: cover;
                                        height: 30vh;
                                        ">
        <div class="container">
            <h1 class="display-4 text-center">{{$listing->from.' - '.$listing->to}}</h1>
        </div>
    </div>
@else
    <div class="jumbotron hero-2">
        <div class="container">
            <h1 class="display-4 text-center">{{$listing->from.' - '.$listing->to}}</h1>
        </div>
    </div>
@endif


<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <div class="row d-flex justify-content-center">
                        <h4><i class="fa fa-map-marker-alt"></i> {{__('text.from_city', ['from' => $listing->from])}}</h4>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="listing-type fa fa-4x fa-{{$listing->type == 'driver' ? 'car' : 'user'}}"></div>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <h4><i class="fa fa-map-marker-alt"></i> {{__('text.to_city', ['to' => $listing->to])}}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group">
                @if ($listing->departure)
                    <li class="list-group-item">
                        <h5><i class="fa fa-calendar-alt"></i> {{__('text.leaving', ['date'=> $listing->departure->formatLocalized(config('app.date_format'))])}}</h5>
                    </li>
                    <li class="list-group-item">
                        <h5><i class="fa fa-clock"></i> {{$listing->departure->formatLocalized(config('app.time_format'))}}</h5>
                    </li>
                @endif
                @if ($listing->price)
                    <li class="list-group-item">
                        <h5 class="price"><i class="fa fa-money-bill-wave"></i> {{$listing->currency.$listing->price}}</h5>
                    </li>
                @endif
                <li class="list-group-item">
                    @if ($listing->type == 'driver')
                        <h5><i class="fa fa-car"></i> {{trans_choice('text.driver_looking_for_passengers', $listing->seats, ['passenger_count'=>$listing->seats])}}</h5>
                    @else
                        <h5><i class="fa fa-user"></i> {{trans_choice('text.passenger_looking_for_driver', $listing->seats, ['passenger_count'=>$listing->seats])}}</h5>
                    @endif
                </li>
                @if ($listing->note)
                    <li class="list-group-item">
                        <p><i class="fa fa-pen"></i> {{$listing->note}}</p>
                    </li>
                @endif

            </ul>
            @if (config('app.fb_share_enabled'))
                <div class="fb-share-button mt-2" data-href="{{Request::url()}}" data-layout="button" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{Request::url()}}" class="fb-xfbml-parse-ignore">{{__('text.share')}}</a></div>
            @endif
        </div>

        @if ($listing->user)
        <div class="card-footer">
            <div class="row">
                <div class="col-auto mr-3">
                    <div class="row">
                        <div class="col-auto">
                            @if ($listing->user->getFirstMediaUrl('user-images', 'thumb'))
                                <img src="{{ $listing->user->getFirstMediaUrl('user-images', 'thumb') }}" class="img rounded-circle mr-2" width="50" height="50" alt="{{$listing->user->name}}">
                            @elseif($listing->user->gender == 'female')
                                <img src="{{ asset('images/no-image-female.jpg') }}" class="img rounded-circle mr-2" width="50" height="50" alt="{{$listing->user->name}}">
                            @else
                                <img src="{{ asset('images/no-image-male.jpg') }}" class="img rounded-circle mr-2" width="50" height="50" alt="{{$listing->user->name}}">
                            @endif
                        </div>
                        <div class="col">
                            <div class="row">
                                @if ($listing->user->role_id >= 2)
                                    <span class="badge badge-success mt-1 mb-1 mr-1">{{$listing->user->role->name}}</span>
                                @endif
                                <a href="{{route('profile', $listing->user)}}">{{$listing->user->name}}</a>
                            </div>
                            <div class="row">
                                <p class="small mb-0"><i class="fa fa-clock"></i> {{$listing->updated_at->diffForHumans()}}</p>
                            </div>
                            <div class="row ml-0">
                            @can('update', $listing)
                                @include('inc.listing.edit_listing')
                            @endcan
                            @can('delete', $listing)
                                <form action="{{route('listing.destroy', $listing->slug)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="delete-listing" data-slug="{{$listing->slug}}" class="my-2 mr-2 btn-danger"><i class="fa fa-trash-alt"></i></button>
                                </form>
                            @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    @if ($listing->phone)
                        <div class="row mt-2">
                            <a href="tel:{{$listing->phone}}"><button class="btn btn-warning"><i class="fa fa-phone"></i> {{$listing->phone}}</button></a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
        @endif
    </div>

</div>

@endsection

