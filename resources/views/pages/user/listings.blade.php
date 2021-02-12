@extends('layouts.app')

@section('content')
@include('inc.hero-2')
<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-3 col-lg-3">
            @include('inc.home_sidebar')
        </div>
        <div class="col-sm-9 col-md-9 col-lg-9">
            @include('inc.listing.listings')
        </div>
    </div>

</div>
@endsection
