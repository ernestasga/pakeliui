<ul class="list-group mb-3">
    <li class="list-group-item {{Route::is('home') ? 'active' : ''}}">
        <a class="dropdown-item" href="{{route('home')}}"><i class="fa fa-home"></i>  {{__('page.dashboard')}}</a>
    </li>
    <li class="list-group-item">
        <a class="dropdown-item" href="{{route('hotline.index')}}"><i class="fa fa-fire"></i>  {{__('text.hotline')}}</a>
    </li>
    <li class="list-group-item">
        <a class="dropdown-item" href="{{route('listing.create')}}"><i class="fa fa-pen"></i>  {{__('text.create_new_listing')}}</a>
    </li>
    <li class="list-group-item">
        <a class="dropdown-item" href="{{route('listing.index')}}"><i class="fa fa-list"></i>  {{__('text.search')}}</a>
    </li>
    <li class="list-group-item {{Route::is('home.profile') ? 'active' : ''}}">
        <a class="dropdown-item" href="{{route('home.profile', Auth::user())}}"><i class="fa fa-user"></i>  {{__('page.my_profile')}}</a>
    </li>
    <li class="list-group-item">
        <a type="submit" class="dropdown-item" href="javascript:void" onclick="$('#logout-form').submit()"><i class="fa fa-sign-out-alt"></i>  {{__('auth.logout')}}</a>
    </li>
</ul>
