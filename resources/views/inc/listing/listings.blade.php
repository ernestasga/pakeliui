<div class="card-header">
    <h4 class="text-center">{{trans_choice('text.ad', 2)}}</h4>
</div>
{{-- Pagination --}}
@if ($listings instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="d-flex justify-content-center">
        {!! $listings->links() !!}
    </div>
@endif

@if ($listings->count() > 0)
    @foreach ($listings as $i=>$listing)
        @include('inc.ad.integrated_ad')
        <div class="card mb-4 pt-2 listing {{$listing->vip}}" id="{{$listing->slug}}" onclick="location.href='{{route('listing.show', $listing)}}'">
            <div class="row align-items-center h-100">
                <div class="col-12 col-sm-12 col-md ml-2">
                    <div class="row d-flex justify-content-center">
                        <a href="{{route('listing.show', $listing->slug)}}">
                            <h4><i class="fa fa-map-marker-alt"></i> {{__('text.from_city', ['from' => $listing->from])}}</h4>
                        </a>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <a href="{{route('listing.show', $listing->slug)}}">
                            <div class="listing-type fa fa-4x fa-{{$listing->type == 'driver' ? 'car' : 'user'}}"></div>
                        </a>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <a href="{{route('listing.show', $listing->slug)}}">
                            <h4><i class="fa fa-map-marker-alt"></i> {{__('text.to_city', ['to' => $listing->to])}}</h4>
                        </a>
                    </div>
                </div>

                <div class="pl-4">
                    <div class="col-auto col-sm-4 col-md">
                        @if ($listing->price)
                            <div class="row">
                                <h5 class="price"><i class="fa fa-money-bill-wave"></i> {{$listing->currency.$listing->price}}</h5>
                            </div>
                        @endif

                        <div class="row">
                            @if ($listing->type == 'driver')
                                <h5><i class="fa fa-car"></i> {{__('text.driver')}}</h5>
                            @else
                                <h5><i class="fa fa-user"></i> {{__('text.passenger')}}</h5>
                            @endif
                        </div>
                        <div class="row">
                            <h5><i class="fa fa-user-friends "></i> {{$listing->seats}}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-auto col-sm-4 col-md">
                    @if ($listing->departure)
                        <div class="col-12">
                            <p class="small"><i class="fa fa-calendar-alt"></i><b> {{__('text.leaving', ['date'=> $listing->departure->formatLocalized(config('app.date_format'))])}}</b></p>
                        </div>
                        <div class="col-12">
                            <p class="small"><i class="fa fa-clock"></i><b> {{$listing->departure->formatLocalized(config('app.time_format'))}}</b></p>
                        </div>
                    @endif
                </div>
                @if ($listing->user)
                    <div class="col-12 col-sm-4 col-md d-none d-sm-block">
                        <div class="row">
                            <div class="col-auto col-sm-auto">
                                @if ($listing->user->getFirstMediaUrl('user-images', 'thumb'))
                                    <img src="{{ $listing->user->getFirstMediaUrl('user-images', 'thumb') }}" class="img rounded-circle mr-2" width="50" height="50" alt="{{$listing->user->name}}">
                                @elseif($listing->user->gender == 'female')
                                    <img src="{{ asset('images/no-image-female.jpg') }}" class="img rounded-circle mr-2" width="50" height="50" alt="{{$listing->user->name}}">
                                @else
                                    <img src="{{ asset('images/no-image-male.jpg') }}" class="img rounded-circle mr-2" width="50" height="50" alt="{{$listing->user->name}}">
                                @endif
                            </div>
                            <div class="col-auto col-sm-auto">
                                <div class="col-12">
                                    @if ($listing->user->isVip())
                                        <span class="badge badge-success mt-1 mb-1 mr-1">{{$listing->user->role->name}}</span>
                                    @endif
                                    <a href="{{route('profile', $listing->user)}}">{{$listing->user->name}}</a>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0"><i class="fa fa-clock"></i> {{$listing->updated_at->diffForHumans()}}</p>
                                </div>
                                <div class="col-12">
                                    <div class="row">
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
                    </div>
                @endif

            </div>
            @if ($listing->user)
                <div class="card-footer d-block d-sm-none">
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
                        <div class="col-auto">
                            @if ($listing->user->isVip())
                                <span class="badge badge-success mt-1 mb-1 mr-1">{{$listing->user->role->name}}</span>
                            @endif
                            <a href="{{route('profile', $listing->user)}}">{{$listing->user->name}}</a>
                            <p class="small mb-0"><i class="fa fa-clock"></i> {{$listing->updated_at->diffForHumans()}}</p>
                        </div>
                        <div class="col-auto">
                            <div class="row">
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
            @endif

        </div>
    @endforeach
@else
    <div class="card">
        <div class="card-header">
            <h5 class="text-center">{{__('text.nothing_to_show')}}</h5>
        </div>
    </div>
@endif

{{-- Pagination --}}
@if ($listings  instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="d-flex justify-content-center">
        {!! $listings->links() !!}
    </div>
@endif


