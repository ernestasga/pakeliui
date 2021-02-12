@extends('layouts.admin')

@section('content_header')
    <h1>{{__('admin.listings')}}</h1>
@stop

@section('content')
<table class="datatables">
    <thead>
        <tr>
            <th># ID</th>
            <th>{{__('admin.country')}}</th>
            <th>{{__('admin.user')}}</th>
            <th>{{__('admin.from')}}</th>
            <th>{{__('admin.to')}}</th>
            <th>{{__('admin.departure')}}</th>
            <th>{{__('admin.type')}}</th>
            <th>{{__('admin.seats')}}</th>
            <th>{{__('admin.price')}}</th>
            <th>{{__('admin.phone')}}</th>
            <th>{{__('admin.created_at')}}</th>
            <th>{{__('text.delete')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($listings as $listing)
        <tr>
            <td><a href="{{route('listing.show', $listing)}}">{{$listing->id}}</a></td>
            <td>{{__('countries.'.$listing->country->code)}}</td>
            <td><a href="{{route('profile', $listing->user)}}">{{$listing->user->name}}</a></td>
            <td>{{$listing->from}}</td>
            <td>{{$listing->to}}</td>
            <td>{{$listing->departure->formatLocalized(config('app.datetime_format'))}}</td>
            <td>{{__('text.'.$listing->type)}}</td>
            <td>{{$listing->seats}}</td>
            <td>{{$listing->currency.$listing->price}}</td>
            <td>{{$listing->phone}}</td>
            <td>{{$listing->created_at->diffForHumans()}}</td>
            <form action="{{route('listing.destroy', $listing)}}" method="post">
                @csrf
                @method('DELETE')
                <td><button type="submit" class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></td>
            </form>
        </tr>
        @endforeach

    </tbody>
</table>
@stop

