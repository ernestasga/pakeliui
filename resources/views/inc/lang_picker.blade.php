<div class="dropdown language">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="flag-icon flag-icon-{{app()->getLocale()=='en'?'us':app()->getLocale()}}"></span> {{config('app.languages.'.app()->getLocale())}}
    </button>
    <div class="dropdown-menu dropdown-menu-right text-right language">
        @foreach (config('app.languages') as $langLocale=>$langName)
            <a class="dropdown-item" href="{{ url()->current() }}?lang={{ $langLocale }}"><span class="flag-icon flag-icon-{{$langLocale=='en'?'us':$langLocale}}"> </span> {{$langName}}</a>
        @endforeach
    </div>
</div>
