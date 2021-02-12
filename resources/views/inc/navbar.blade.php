<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}">
            <img src="/images/logo_text.png" alt="" height="35">
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('hotline.index')}}"><i class="fa fa-fire"></i>  {{__('text.hotline')}} <span class="badge badge-light"> {{$hotline_count}}</span></a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('listing.index')}}"><i class="fa fa-list"></i>  {{trans_choice('text.ad', 2)}} <span class="badge badge-light"> {{$listing_count}}</span></a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('listing.create')}}"><i class="fa fa-pen"></i>  {{__('text.create')}}</a></li>
                @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{route('login')}}"><i class="fa fa-sign-in-alt"></i> {{__('auth.login')}}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if (Auth::user()->getFirstMediaUrl('user-images', 'thumb'))
                                <img src="{{ Auth::user()->getFirstMediaUrl('user-images', 'thumb') }}" class="img rounded-circle mr-2" width="25" height="25" >
                            @elseif(Auth::user()->gender == 'female')
                                <img src="{{ asset('images/no-image-female.jpg') }}" class="img rounded-circle mr-2" width="25" height="25">
                            @else
                                <img src="{{ asset('images/no-image-male.jpg') }}" class="img rounded-circle mr-2" width="25" height="25"0>
                            @endif
                            {{Auth::user()->name}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('home')}}"><i class="fa fa-home"></i>  {{__('page.dashboard')}}</a>
                            <a class="dropdown-item" href="{{route('home.profile', Auth::user())}}"><i class="fa fa-user"></i>  {{__('page.my_profile')}}</a>

                        <div class="dropdown-divider"></div>
                            <a type="submit" class="dropdown-item" href="javascript:void" onclick="$('#logout-form').submit()"><i class="fa fa-sign-out-alt"></i>  {{__('auth.logout')}}</a>
                        <form action="{{route('logout')}}" method="post" id="logout-form">@csrf</form>
                        </div>
                    </li>
                @endif
                @include('inc.lang_picker')

            </ul>
        </div>
    </div>
</nav>
