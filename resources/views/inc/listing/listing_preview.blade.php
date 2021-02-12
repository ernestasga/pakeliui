<div class="card mb-4 pl-4 pt-2 listing" id="listing-preview-card">
    <div class="row align-items-center h-100">
        <div class="col-12 col-sm-12 col-md">
            <div class="row d-flex justify-content-center">
                <a href="#">
                    <h4 id="listing-preview-from"><i class="fa fa-map-marker-alt"></i> ...</h4>
                </a>
            </div>
            <div class="row d-flex justify-content-center">
                <a href="#">
                    <div class="flag-xl flag-icon flag-icon-lt"></div>
                </a>
            </div>
            <div class="row d-flex justify-content-center">
                <a href="#">
                    <h4 id="listing-preview-to"><i class="fa fa-map-marker-alt"></i> ...</h4>
                </a>
            </div>
        </div>

        <div class="col-4 col-sm-4 col-md">

            <div class="row">
                <h5 class="price" id="listing-preview-price"></h5>
            </div>
            <div class="row">
                <h5 id="listing-preview-type"><i class="fa fa-car"></i> ...</h5>
            </div>
            <div class="row">
                <h5  id="listing-preview-seats"><i class="fa fa-user-friends "></i> ...</h5>
            </div>
        </div>
        <div class="col-4 col-sm-4 col-md">
            <div class="row">
                <p class="small" id="listing-preview-departure-date"><i class="fa fa-calendar-alt"></i> ...</p>
            </div>
            <div class="row">
                <p class="small" id="listing-preview-departure-time"><i class="fa fa-clock"></i> ...</p>
            </div>
        </div>
        <div class="col-4 col-sm-4 col-md">
            <div class="row">
                <div class="col-12 col-md-auto">
                    @if (Auth::user()->getFirstMediaUrl('user-images', 'thumb'))
                        <img src="{{ Auth::user()->getFirstMediaUrl('user-images', 'thumb') }}" class="img rounded-circle mr-2" width="50" height="50" alt="{{Auth::user()->name}}">
                    @elseif(Auth::user()->gender == 'female')
                        <img src="{{ asset('images/no-image-female.jpg') }}" class="img rounded-circle mr-2" width="50" height="50" alt="{{Auth::user()->name}}">
                    @else
                        <img src="{{ asset('images/no-image-male.jpg') }}" class="img rounded-circle mr-2" width="50" height="50" alt="{{Auth::user()->name}}">
                    @endif
                </div>
                <div class="col">
                    <div class="col-12">
                        @if (Auth::user()->isVip())
                            <span class="badge badge-success mt-1 mb-1 mr-1">{{Auth::user()->role->name}}</span>
                        @endif
                        {{Auth::user()->name}}
                    </div>
                    <div class="col-12">
                        <p class="small mb-0"><i class="fa fa-clock"></i> {{now()->diffForHumans()}}</p>
                    </div>
                    <div class="col-12">
                        <div class="row ">
                            <button class="my-2 mr-2 btn-primary"><i class="fa fa-edit"></i></button>
                            <button type="submit" id="delete-listing" class="my-2 mr-2 btn-danger"><i class="fa fa-trash-alt"></i></button>

                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
