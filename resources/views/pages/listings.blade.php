@extends('layouts.app')

@section('content')
<div class="jumbotron hero-2">
    <div class="container">
        <h1 class="display-4 text-center my-5">{{trans_choice('text.ad', 2)}}</h1>
        <p class="display-5 text-center my-5"></p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-lg-3">
            @include('inc.search.search-inline')
        </div>
        <div class="col-12 col-lg-9">
            @include('inc.listing.listings')
        </div>
    </div>
</div>

@endsection
