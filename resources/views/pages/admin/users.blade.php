@extends('layouts.admin')
@section('content_header')
    <h1>{{__('admin.users')}}</h1>
@stop
@section('content')
    <table class="datatables">
        <thead>
            <tr>
                <th># ID</th>
                <th>{{__('admin.name')}}</th>
                <th>{{__('admin.email')}}</th>
                <th>{{__('admin.email_verified')}}</th>
                <th>{{__('admin.role')}}</th>
                <th>{{__('admin.country')}}</th>
                <th>{{__('admin.city')}}</th>
                <th>{{__('admin.gender')}}</th>
                <th>{{__('admin.phone')}}</th>
                <th>{{__('admin.listings')}}</th>
                <th>{{__('admin.hotline')}}</th>
                <th>{{__('admin.created_at')}}</th>
                <th>{{__('text.update')}}</th>
                <th>{{__('text.delete')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <form action="{{route('admin.users.update.role', $user)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <td>{{$user->id}}</td>
                    <td><a href="{{route('profile', $user)}}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->email_verified ? __('text.yes') : __('text.no')}}</td>
                    <td>
                        <select name="role">
                            @foreach (\App\Models\Role::all() as $role)
                                <option {{$role->id === $user->role->id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>{{__('countries.'.$user->country->code)}}</td>
                    <td>{{$user->city}}</td>
                    <td>{{$user->gender ? __('text.'.$user->gender) : ''}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->listing->count()}}</td>
                    <td>{{$user->hotlineMessage->count()}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td><button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button></td>
                </form>
                <form action="{{route('user.delete', $user)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <td><button type="submit" class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></td>
                </form>
            </tr>
            @endforeach

        </tbody>
    </table>
@stop

