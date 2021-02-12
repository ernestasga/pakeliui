@extends('layouts.app')

@section('content')
@include('inc.hero-1')
<div class="container">
    @include('inc.listing.listings')
    @if ($listings->count()>0)
        <div class="row d-flex justify-content-center mb-3">
            <a href="{{route('listing.store')}}"><button class="btn btn-info">{{__('text.all_listings')}}</button></a>
        </div>
    @endif

    @include('inc.plans')
</div>

@endsection
