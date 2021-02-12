<button class="my-2 mr-2 btn-primary" data-toggle="modal" data-target="#edit-{{$listing->id}}"><i class="fa fa-edit"></i></button>
<!-- Modal -->
<div class="modal fade" id="edit-{{$listing->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('text.edit_listing')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{route('listing.update', $listing)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row form-group">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="from">{{__('text.from')}}*</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" name="from" class="form-control autocomplete-city @error('from') is-invalid @enderror", placeholder="{{__('text.from')}}" value="{{ $listing->from }}" maxlength="255" required>
                            </div>
                            @error('from')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="to">{{__('text.to')}}*</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" name="to" class="form-control autocomplete-city @error('to') is-invalid @enderror", placeholder="{{__('text.to')}}" value="{{ $listing->to }}" maxlength="255" required>
                            </div>
                            @error('to')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row form-group">

                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <label for="departure">{{__('text.departure')}}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" data-field="datetime" name="departure" class="form-control @error('departure') is-invalid @enderror" placeholder="{{__('text.departure')}}" value="{{ date('d-m-Y H:i', strtotime($listing->departure)) }}"  data-min="{{date('d-m-Y H:i')}}" required>

                            </div>
                            @error('departure')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div id="datetimepicker"></div>

                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <label for="price">{{__('text.price')}} €</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-money-bill-wave"></i></span>
                                </div>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="{{__('text.price')}}" value="{{$listing->price}}" min="1" max="999" step="0.1">
                            </div>
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>

                    <div class="row form-group">
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                              <label for="seats">{{__('text.seats')}}*</label>
                              <h6 id="seats_label">{{$listing->seats}}</h6>
                              <input type="range" class="custom-range seats_slider" name="seats" step="1" min="1" max="9" value="{{$listing->seats}}" >
                              @error('seats')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <label for="phone">{{__('text.phone')}}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror", placeholder="{{__('text.phone')}}" value="{{ $listing->phone }}" maxlength="30" required>
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
                        <textarea class="form-control @error('note') is-invalid @enderror" name="note" cols="50" rows="2" maxlength="2000">{{$listing->note}}</textarea>
                        @error('note')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

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
                                    <input class="form-check-input" id="listing-vip-1" type="radio" name="vip" value="listing-vip-1" {{$listing->vip=='listing-vip-1'? 'checked':''}}>
                                    <label class="form-check-label" for="vip">{{__('text.custom_vip_1')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="listing-vip-2" type="radio" name="vip" value="listing-vip-2" {{$listing->vip=='listing-vip-2'? 'checked':''}}>
                                    <label class="form-check-label" for="vip">{{__('text.custom_vip_2')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="listing-vip-3" type="radio" name="vip" value="listing-vip-3" {{$listing->vip=='listing-vip-3'? 'checked':''}}>
                                    <label class="form-check-label" for="vip">{{__('text.custom_vip_3')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="listing-vip-4" type="radio" name="vip" value="listing-vip-4" {{$listing->vip=='listing-vip-4'? 'checked':''}}>
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
                                    <input class="form-check-input" id="listing-vip-1" type="radio" name="vip" value="listing-vip-1" disabled {{$listing->vip=='listing-vip-1'? 'checked':''}}>
                                    <label class="form-check-label" for="vip">{{__('text.custom_vip_1')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="listing-vip-2" type="radio" name="vip" value="listing-vip-2" disabled {{$listing->vip=='listing-vip-2'? 'checked':''}}>
                                    <label class="form-check-label" for="vip">{{__('text.custom_vip_2')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="listing-vip-3" type="radio" name="vip" value="listing-vip-3" disabled {{$listing->vip=='listing-vip-3'? 'checked':''}}>
                                    <label class="form-check-label" for="vip">{{__('text.custom_vip_3')}}</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="listing-vip-4" type="radio" name="vip" value="listing-vip-4" disabled {{$listing->vip=='listing-vip-4'? 'checked':''}}>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('text.cancel')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('text.save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
