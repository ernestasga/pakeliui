<div class="card card-3 hero-form">
    <div class="card-header">
        {{__('text.search')}}
    </div>
    <div class="card-body">
        <form action="{{route('listing.index')}}" method="get" class="search-form">
            <div class="row form-group">
                <div class="col-12 col-sm-6 col-md-6 col-lg-6 ">
                    <label for="filter[from]"><b>{{__('text.from')}}</b></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" name="filter[from]" class="form-control autocomplete-city" placeholder="{{__('text.from')}}" value="{{ old('from') }}" maxlength="255">
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <label for="filter[to]"><b>{{__('text.to')}}</b></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                        </div>
                        <input type="text" name="filter[to]" class="form-control autocomplete-city" placeholder="{{__('text.to')}}" value="{{ old('to') }}" maxlength="255">
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <label class="text-center" for="departure_from"><b>{{__('text.departure_from')}}</b></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" data-field="datetime" name="filter[departure_from]" class="form-control" placeholder="{{__('text.departure_from')}}" data-min="{{date('d-m-Y H:i')}}">
                    </div>
                </div>
                <div id="datetimepicker"></div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <label for="departure_to"><b>{{__('text.departure_to')}}</b></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" data-field="datetime" name="filter[departure_to]" class="form-control" placeholder="{{__('text.departure_to')}}" data-min="{{date('d-m-Y H:i')}}">
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                    <label for="type"><b>{{__('text.i_am_looking_for')}}</b></label>
                    <div class="input-group">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-secondary active">
                                <i class="fa fa-car"></i>
                                <input type="radio" name="filter[type]" value="driver"> {{__('text.looking_for_driver')}}
                            </label>
                            <label class="btn btn-secondary">
                                <i class="fa fa-user"></i>
                                <input type="radio" name="filter[type]" value="passenger"> {{__('text.looking_for_passenger')}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row form-group justify-content-center">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <button type="submit" class="form-control btn btn-danger"><i class="fa fa-search"></i> {{__('text.search')}}</button>
                </div>
                <div class="col-12 col-sm-12 col-md-2 col-lg-2">
                    <div class="text-center">{{__('text.or')}}</div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <a href="{{route('listing.create')}}"><button type="button" class="form-control btn btn-success"><i class="fa fa-pen"></i> {{__('text.create')}}</button></a>
                </div>
            </div>
        </form>
    </div>
</div>
