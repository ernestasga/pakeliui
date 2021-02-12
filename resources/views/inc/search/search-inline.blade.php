<div class="card">
    <div class="card-header">
        <h4 class="text-center">{{__('text.search')}}</h4>

    </div>
    <div class="card-body">

    <form class="pb-4 search-form" action="{{route('listing.index')}}" method="get" >
        <div class="row form-group">
            <div class="col-12 col-sm-6 col-md-6 col-lg-12">
                <label for="filter[from]"><b>{{__('text.from')}}</b></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                    </div>
                    <input type="text" name="filter[from]" class="form-control autocomplete-city" placeholder="{{__('text.from')}}" value="{{ isset(request()->filter['from']) ? request()->filter['from'] : '' }}" maxlength="255">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-12">
                <label for="filter[to]"><b>{{__('text.to')}}</b></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                    </div>
                    <input type="text" name="filter[to]" class="form-control autocomplete-city" placeholder="{{__('text.to')}}" value="{{ isset(request()->filter['to']) ? request()->filter['to'] : '' }}" maxlength="255">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-12">
                <label for="departure_from"><b>{{__('text.departure_from')}}</b></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" data-field="datetime" name="filter[departure_from]" class="form-control" placeholder="{{__('text.departure_from')}}" data-min="{{date('d-m-Y H:i')}}" value="{{ isset(request()->filter['departure_from']) ? request()->filter['departure_from'] : '' }}">
                </div>
            </div>
            <div id="datetimepicker"></div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-12">
                <label for="departure_to"><b>{{__('text.departure_to')}}</b></label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" data-field="datetime" name="filter[departure_to]" class="form-control" placeholder="{{__('text.departure_to')}}" data-min="{{date('d-m-Y H:i')}}" value="{{ isset(request()->filter['departure_to']) ? request()->filter['departure_to'] : '' }}">
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-12">
                <label for="type"><b>{{__('text.i_am_looking_for')}}</b></label>
                <div class="input-group">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                        <label class="btn btn-secondary active">
                            <i class="fa fa-car"></i>
                            <input type="radio" name="filter[type]" value="driver" {{ (isset(request()->filter['type']) && request()->filter['type'] == 'driver') ? 'checked' : '' }}> {{__('text.looking_for_driver')}}
                        </label>
                        <label class="btn btn-secondary">
                            <i class="fa fa-user"></i>
                            <input type="radio" name="filter[type]" value="passenger" {{ (isset(request()->filter['type']) && request()->filter['type'] == 'passenger') ? 'checked' : '' }}> {{__('text.looking_for_passenger')}}
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col text-center">
                <button class="btn btn-danger float-center"><i class="fa fa-search"></i> {{__('text.search')}}</button>
            </div>
        </div>
    </form>

    </div>
</div>
