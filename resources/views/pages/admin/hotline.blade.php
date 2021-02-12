@extends('layouts.admin')

@section('content_header')
    <h1>{{__('admin.hotline')}}</h1>
@stop

@section('content')
<table class="datatables">
    <thead>
        <tr>
            <th># ID</th>
            <th>{{__('admin.user')}}</th>
            <th>{{trans_choice('text.hotline_message', 1)}}</th>
            <th>{{__('text.vip_options')}}</th>
            <th>{{__('admin.created_at')}}</th>
            <th>{{__('text.update')}}</th>
            <th>{{__('text.delete')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($messages as $message)
        <tr>
            <form action="{{route('hotline.update', $message)}}" method="POST">
                @csrf
                @method('PUT')
                <td>{{$message->id}}</td>
                <td><a href="{{route('profile', $message->user)}}">{{$message->user->name}}</a></td>
                <td><input name="message" type="text" class="form-control" value="{{$message->message}}"></td>
                <td><input name="vip" type="text" class="form-control" value="{{$message->vip}}"></td>
                <td>{{$message->created_at->diffForHumans()}}</td>
                <td><button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button></td>

            </form>
            <form action="{{route('hotline.destroy', $message)}}" method="post">
                @csrf
                @method('DELETE')
                <td><button type="submit" class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></td>
            </form>
        </tr>
        @endforeach

    </tbody>
</table>
@stop

