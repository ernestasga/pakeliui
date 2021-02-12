@extends('layouts.app')

@section('content')
<div class="jumbotron hero-2">
    <div class="container">
        <h1 class="display-4 text-center my-5">{{__('text.create_new_listing')}}</h1>
        <p class="display-5 text-center my-5"></p>
    </div>
</div>

@can('create', \App\Models\Listing::class)

<div class="container">
    <div class="step-app" id="wizard">
        <ul class="step-steps">
          <li data-step-target="step1" class="text-center"><i class="fa fa-globe"></i> {{__('text.where_and_when')}}</li>
          <li data-step-target="step2" class="text-center"><i class="fa fa-info"></i> {{__('text.info')}}</li>
          <li data-step-target="step3" class="text-center"><i class="fa fa-flag"></i> {{__('text.review')}}</li>
        </ul>
        <div class="step-content">
            <div class="step-tab-panel" data-step="step1">
                <form role="form" method="POST" id="create-form" action="{{route('listing.store')}}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>{{__('text.country')}}*</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fa fa-globe"></i></span>
                                      </div>
                                      <select class="form-control @error('country') is-invalid @enderror" name="country" required>
                                          @foreach (\App\Models\Country::all() as $i=>$country)
                                              @if ($i==3)
                                                  <option disabled></option>
                                              @endif
                                              <option {{Auth::user()->country_id == $i+1 ? 'selected' : ''}} value="{{$i+1}}">{{__('countries.'.$country->code)}}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                    @error('country')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="departure">{{__('text.departure')}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" data-field="datetime" name="departure" id="create-departure" class="form-control @error('departure') is-invalid @enderror" placeholder="{{__('text.departure')}}" value="{{ old('departure') }}" data-min="{{date('d-m-Y H:i')}}" required>
                                    </div>
                                    @error('departure')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div id="datetimepicker"></div>

                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6">
                                <div class="form-group create-from">
                                    <label for="from">{{__('text.from')}}*</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" name="from" id="create-from" class="form-control autocomplete-city @error('from') is-invalid @enderror", placeholder="{{__('text.from')}}" value="{{ old('from') }}" maxlength="255" required>
                                    </div>

                                    @error('from')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="to">{{__('text.to')}}*</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" name="to" id="create-to" class="form-control autocomplete-city @error('to') is-invalid @enderror", placeholder="{{__('text.to')}}" value="{{ old('to') }}" maxlength="255" required>
                                    </div>
                                    @error('to')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="step-tab-panel" data-step="step2">
                <div class="container">
                    <div class="row form-group">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                              <label for="seats">{{__('text.seats')}}*</label>
                              <h6 id="seats_label">1</h6>
                              <input type="range" class="custom-range seats_slider" name="seats" step="1" min="1" max="9" value="1" required>

                              @error('seats')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                          </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <label for="price">{{__('text.price')}} €</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-money-bill-wave"></i></span>
                                </div>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="{{__('text.price')}}" value="{{ old('price') }}" min="1" max="999" step="0.1">
                            </div>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="row form-group">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="type">{{__('text.i_am')}}*</label>
                                <div class="input-group">
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-secondary active">
                                            <i class="fa fa-car"></i>
                                            <input type="radio" name="type" value="driver" {{ old('type')=='driver' ? 'checked' : '' }} required> {{__('text.driver')}}
                                        </label>
                                        <label class="btn btn-secondary">
                                            <i class="fa fa-user"></i>
                                            <input type="radio" name="type" value="passenger" checked {{ old('type')=='passenger' ? 'checked' : '' }} required> {{__('text.passenger')}}
                                        </label>
                                    </div>
                                </div>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="phone">{{__('text.phone')}}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror", placeholder="{{__('text.phone')}}" value="{{ Auth::user()->phone }}" maxlength="30" required>
                            </div>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="pb-2" for="note">{{__('text.note')}}</label>
                        <textarea class="form-control @error('note') is-invalid @enderror" name="note" cols="50" rows="2" maxlength="2000"></textarea>
                        @error('note')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="step-tab-panel" data-step="step3">
                <div class="container">
                    <div class="col">
                        <div class="col">
                            <h3>{{__('text.review')}}</h3>

                            @include('inc.listing.listing_preview')

                            @can('customize', \App\Models\Listing::class)
                                <div class="card">
                                    <div class="card-header">
                                        {{__('text.vip_options')}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="image">{{__('text.choose_image')}}</label>
                                            <input type="file" class="form-control-file" name="image">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="listing-vip-0" type="radio" name="vip" value="">
                                                <label class="form-check-label" for="vip">{{__('text.custom_default')}}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="listing-vip-1" type="radio" name="vip" value="listing-vip-1">
                                                <label class="form-check-label" for="vip">{{__('text.custom_vip_1')}}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="listing-vip-2" type="radio" name="vip" value="listing-vip-2">
                                                <label class="form-check-label" for="vip">{{__('text.custom_vip_2')}}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="listing-vip-3" type="radio" name="vip" value="listing-vip-3">
                                                <label class="form-check-label" for="vip">{{__('text.custom_vip_3')}}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="listing-vip-4" type="radio" name="vip" value="listing-vip-4">
                                                <label class="form-check-label" for="vip">{{__('text.custom_vip_4')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-header text-center">
                                        {{__('text.vip_options')}}
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="image">{{__('text.choose_image')}}</label>
                                            <input type="file" class="form-control-file" name="image" disabled>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="listing-vip-0" type="radio" name="vip" value="" disabled>
                                                <label class="form-check-label" for="vip">{{__('text.custom_default')}}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="listing-vip-1" type="radio" name="vip" value="listing-vip-1" disabled>
                                                <label class="form-check-label" for="vip">{{__('text.custom_vip_1')}}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="listing-vip-2" type="radio" name="vip" value="listing-vip-2" disabled>
                                                <label class="form-check-label" for="vip">{{__('text.custom_vip_2')}}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="listing-vip-3" type="radio" name="vip" value="listing-vip-3" disabled>
                                                <label class="form-check-label" for="vip">{{__('text.custom_vip_3')}}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" id="listing-vip-4" type="radio" name="vip" value="listing-vip-4"disabled>
                                                <label class="form-check-label" for="vip">{{__('text.custom_vip_4')}}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        @include('inc.become_vip_now')
                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="step-footer">
            <button data-step-action="prev" class="btn btn-danger"><i class="fa fa-arrow-left"></i> {{__('text.back')}}</button>
            <button data-step-action="next" class="btn btn-primary">{{__('text.next')}} <i class="fa fa-arrow-right"></i></button>
            <button data-step-action="finish" class="btn btn-success"><i class="fa fa-flag"></i> {{__('text.create')}}</button>
        </div>
      </div>
</div>
@else
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <h4>{{__('text.cannot_create_1')}}</h4>
        </div>
        <div class="card-body">
            <p class="card-title text-center">{{__('text.cannot_create_2', ['regular_limit'=>config('limits.regular_user_max_active_listings'), 'vip_limit'=>config('limits.vip_user_max_active_listings')])}}</p>
            <p class="text-center">{{__('text.see_your_listings')}} <a href="{{route('home')}}">{{__('page.my_listings')}}</a></p>
        </div>
        <div class="card-footer text-center">
            @include('inc.become_vip_now')
        </div>
    </div>
</div>
@endcan
@endsection
