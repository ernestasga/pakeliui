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
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-3">
            <div class="col">
                @include('inc.home_sidebar')
            </div>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-9">
            <div class="col">
                <div class="row">
                  <div class="col mb-3">
                    <div class="card">
                      <div class="card-body">
                        <div class="e-profile">
                          <div class="row">
                            <div class="col-12 col-sm-auto mb-3">
                              <div class="mx-auto" style="width: 140px;">
                                <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                                    @if ($user->getFirstMediaUrl('user-images', 'thumb'))
                                        <img src="{{ $user->getFirstMediaUrl('user-images', 'thumb') }}" alt="{{$user->name}}">
                                    @elseif($user->gender == 'female')
                                        <img src="{{ asset('images/no-image-female.jpg') }}" alt="{{$user->name}}">
                                    @else
                                        <img src="{{ asset('images/no-image-male.jpg') }}" alt="{{$user->name}}">
                                    @endif
                                </div>
                              </div>
                            </div>
                            <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                              <div class="text-center text-sm-left mb-2 mb-sm-0">
                                <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap">{{$user->name}}</h4>
                                <p class="mb-0"><a href="{{route('profile', $user)}}">{{'@'.$user->slug}}</a></p>
                                @if ($user->country)
                                    <p class="mb-0"><span class="flag-icon flag-icon-{{$user->country->code}}"></span> {{__('countries.'.$user->country->code)}}</p>
                                @endif
                                <p class="small mb-0"> <i class="{{$user->city ? 'fas fa-map-marker-alt mr-2':''}}"></i>{{$user->city}}</p>

                                <div class="text-muted"><small>{{__('text.last_updated', ['updated'=>     $user->updated_at->diffForHumans()   ])}}</small></div>
                                <div class="mt-2">
                                  <button class="btn btn-primary m-1" type="button" data-toggle="modal" data-target="#profilePhotoUploadModal">
                                    <i class="fa fa-fw fa-camera"></i>
                                    <span>{{__('text.change_photo')}}</span>
                                  </button>
                                  @can('customize', \App\Models\User::class)
                                    <button class="btn btn-primary m-1" type="button" data-toggle="modal" data-target="#coverPhotoUploadModal">
                                        <i class="fa fa-fw fa-image"></i>
                                        <span>{{__('text.change_cover_photo')}}</span>
                                    </button>
                                  @else
                                    <button class="btn btn-primary m-1" type="button" disabled>
                                        <i class="fa fa-fw fa-image"></i>
                                        <span>{{__('text.change_cover_photo').' - '.__('text.only_for_vip')}}</span>
                                    </button>
                                  @endcan
                                </div>
                              </div>
                              <div class="text-center text-sm-right">
                                <span class="badge badge-success">{{$user->role->name}}</span>
                                <div class="text-muted"><small>{{__('text.joined_date', ['joined'=>$user->created_at->diffForHumans()])}}</small></div>
                              </div>
                            </div>
                          </div>
                          <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="" class="active nav-link">{{__('text.settings')}}</a></li>
                          </ul>
                          <div class="tab-content pt-3">
                            <div class="tab-pane active">
                              <form class="form" action="{{route('home.profile.update', $user)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                  <div class="col">
                                      <!-- Row 1 -->
                                    <div class="row">
                                      <div class="col">
                                        <div class="form-group">
                                          <label>{{__('text.name')}}</label>
                                          <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="John Smith" value="{{$user->name}}" required>
                                           @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                      </div>
                                      <div class="col">
                                        <!-- Empty col -->
                                      </div>
                                    </div>
                                    <!-- Row 2 -->
                                    <div class="row">
                                        <div class="col">
                                          <div class="form-group">
                                            <label>{{__('text.country')}}</label>
                                            <select class="form-control @error('country') is-invalid @enderror" name="country">
                                                @foreach (\App\Models\Country::all() as $i=>$country)
                                                    @if ($i==3)
                                                        <option disabled></option>
                                                    @endif
                                                    <option {{$user->country_id == $i+1 ? 'selected' : ''}} value="{{$i+1}}">{{__('countries.'.$country->code)}}</option>
                                                @endforeach
                                            </select>

                                            @error('country')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                        </div>
                                        <div class="col">
                                          <div class="form-group">
                                            <label>{{__('text.city')}}</label>
                                            <input class="form-control autocomplete-city @error('city') is-invalid @enderror" type="text" name="city" value="{{$user->city}}">
                                              @error('city')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                        </div>
                                      </div>
                                      <!-- Row 3 -->
                                    <div class="row">
                                      <div class="col">
                                        <div class="form-group">
                                          <label>{{__('text.phone')}}</label>
                                          <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{$user->phone}}">
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                      </div>
                                      <div class="col">
                                        <div class="form-group">
                                          <label>{{__('text.gender')}}</label>
                                          <select class="form-control @error('gender') is-invalid @enderror" type="text" name="gender">
                                            <option value="">{{__('text.prefer_not_to_say')}}</option>
                                            <option {{$user->gender == 'male' ? 'selected' : ''}} value="male">{{__('text.male')}}</option>
                                            <option {{$user->gender == 'female' ? 'selected' : ''}} value="female">{{__('text.female')}}</option>
                                          </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                      </div>
                                    </div>
                                    <!-- Row 4 -->
                                    <div class="row">
                                      <div class="col mb-3">
                                        <div class="form-group">
                                          <label>{{__('text.about_me')}}</label>
                                          <textarea class="form-control @error('about') is-invalid @enderror" rows="5" name="about">{{$user->about}}</textarea>
                                            @error('about')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-12 col-sm-6 mb-3">
                                    <div class="mb-2"><b>{{__('text.change_password')}}</b></div>
                                    <a href="{{route('password.request')}}">{{__('auth.reset_password')}}</a>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit">{{__('text.save_changes')}}</button>
                                  </div>
                                </div>
                              </form>
                              <div class="row">
                                <div class="col">
                                    <form action="{{route('user.delete', $user)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">{{__('auth.close_account')}}</button>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            </div>

        </div>
    </div>

</div>



<!-- Profile Photo Modal -->
<div class="modal fade" id="profilePhotoUploadModal" tabindex="-1" role="dialog" aria-labelledby="profilePhotoUploadModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-fw fa-camera"></i>{{__('text.change_photo')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('home.profile.photo.update', $user) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="image">{{__('text.choose_image')}}</label>
                        <input type="file" class="form-control-file" name="image" id="profile-image-upload" required>
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <img class="img-fluid mt-2" src="#" alt="" id="profile-image-preview">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.cancel')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('text.save')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@can('customize', \App\Models\User::class)
<!-- Profile Photo Modal -->
<div class="modal fade" id="coverPhotoUploadModal" tabindex="-1" role="dialog" aria-labelledby="coverPhotoUploadModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-fw fa-image"></i>{{__('text.change_cover_photo')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('home.profile.cover.update', $user) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="image">{{__('text.choose_image')}}</label>
                        <input type="file" class="form-control-file" name="image" id="cover-image-upload" required>
                        @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <img class="img-fluid mt-2" src="#" alt="" id="cover-image-preview" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.cancel')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('text.save')}}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endcan
@endsection
