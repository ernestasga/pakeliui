<div class="card-deck mb-3 text-center">
    @foreach (__('plans') as $plan)
        <div class="card mb-4 box-shadow">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal">{{$plan['name']}}</h4>
        </div>
        <div class="card-body">
            <h1 class="card-title pricing-card-title">{{$plan['price']}} <small class="text-muted">/ {{__('text.mo')}}</small></h1>
            <ul class="list-unstyled mt-3 mb-4">
                @foreach ($plan['attributes'] as $attribute)
                    <li>
                        <i class="fa fa-check"></i> {{$attribute}}
                    </li>
                @endforeach
            </ul>
            @if ($loop->index != 0)
                <a href="{{route('vip')}}"><button type="button" class="btn btn-lg btn-block btn-outline-primary"><i class="fab fa-facebook"></i> {{__('text.contact_us')}}</button></a>
            @endif
        </div>
        </div>
    @endforeach
</div>
