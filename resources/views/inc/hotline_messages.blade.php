<div class="card-header">
    <h4 class="text-center">{{trans_choice('text.hotline_message', 2)}}</h4>
</div>
{{-- Pagination --}}
@if($messages  instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="d-flex justify-content-center">
        {!! $messages->links() !!}
    </div>
@endif

@if ($messages->count() > 0)
@foreach ($messages as $i=>$message)
    @if ($message->user)
    @include('inc.ad.integrated_ad')
    <div class="card mb-4 {{$message->vip}}">
        <div class="row">
            <div class="col-auto ml-1 mt-1 mb-1">
                @if ($message->user->getFirstMediaUrl('user-images', 'thumb'))
                    <img src="{{ $message->user->getFirstMediaUrl('user-images', 'thumb') }}" class="img rounded-circle mr-2" width="50" height="50" alt="{{$message->user->name}}">
                @elseif($message->user->gender == 'female')
                    <img src="{{ asset('images/no-image-female.jpg') }}" class="img rounded-circle mr-2" width="50" height="50" alt="{{$message->user->name}}">
                @else
                    <img src="{{ asset('images/no-image-male.jpg') }}" class="img rounded-circle mr-2" width="50" height="50" alt="{{$message->user->name}}">
                @endif

            </div>
            <div class="col-auto">
                <div class="row d-flex align-items-center">
                    @if ($message->user->isVip())
                        <span class="badge badge-success mr-1">{{$message->user->role->name}}</span>
                    @endif
                    <a href="{{route('profile', $message->user)}}">{{$message->user->name}}</a>
                </div>
                <div class="row">
                    <p class="small mb-0"> <i class="{{$message->user->city ? 'fas fa-map-marker-alt mr-2':''}}"></i>{{$message->user->city}}</p>
                </div>
                <div class="row">
                    <p class="small mb-0"> <i class="fas fa-clock mr-2"></i>{{$message->created_at->diffForHumans()}}</p>
                </div>
            </div>

            <div class="col">
                <p>{{$message->message}}</p>
            </div>
            <div class="col-12 col-sm-auto">
                @can('update', $message)
                    <div class="row float-right mr-2">
                        <form action="{{route('hotline.destroy', $message->slug)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" id="delete-message" data-slug="{{$message->slug}}" class="my-2 mr-2 btn-danger"><i class="fa fa-trash-alt"></i></button>
                        </form>
                    </div>
                @endcan
            </div>
        </div>
    </div>
    @endif
@endforeach
@else
<div class="card">
    <div class="card-header">
        <h5 class="text-center">{{__('text.nothing_to_show')}}</h5>
    </div>
</div>
@endif
{{-- Pagination --}}
@if($messages  instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="d-flex justify-content-center">
        {!! $messages->links() !!}
    </div>
@endif
