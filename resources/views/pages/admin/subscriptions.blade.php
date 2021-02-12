@extends('layouts.admin')

@section('content_header')
    <h1>{{__('admin.subscriptions')}}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="text-center">{{__('admin.new_subscription')}}</h4>
    </div>
    <form action="{{route('admin.subscriptions.create')}}" method="post">
        @csrf
        <div class="card-body col-6 offset-3">
            <div class="form-group">
                <label for="user">{{__('admin.user')}}</label>
                <select name="user" class="form-control @error('user') is-invalid @enderror">
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">#{{$user->id.' '.$user->email.' - '.$user->name.' - '.$user->role->name}}</option>
                    @endforeach
                </select>
            </div>
            @error('user')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="form-group">
                <label for="role">{{__('admin.role')}}</label>
                <select name="role" class="form-control @error('role') is-invalid @enderror">
                    @foreach ($roles as $role)
                        <option {{$role->id==2?'selected':''}} value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
            @error('role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="form-group">
                <label for="expires">{{__('admin.expires_at')}}</label>
                <select name="expires" class="form-control @error('expires') is-invalid @enderror">
                    <option value="{{\Carbon\Carbon::now()->addWeeks(1)}}">{{trans_choice('admin.in_weeks', 1, ['count'=>1])}}</option>
                    <option value="{{\Carbon\Carbon::now()->addWeeks(2)}}">{{trans_choice('admin.in_weeks', 2, ['count'=>2])}}</option>
                    <option value="{{\Carbon\Carbon::now()->addMonths(1)}}">{{trans_choice('admin.in_months', 1, ['count'=>1])}}</option>
                    <option value="{{\Carbon\Carbon::now()->addMonths(2)}}">{{trans_choice('admin.in_months', 2, ['count'=>2])}}</option>
                    <option value="{{\Carbon\Carbon::now()->addMonths(3)}}">{{trans_choice('admin.in_months', 3, ['count'=>3])}}</option>
                    <option value="{{\Carbon\Carbon::now()->addMonths(6)}}">{{trans_choice('admin.in_months', 6, ['count'=>6])}}</option>
                </select>
            </div>
            @error('expires')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{__('text.create')}}</button>
        </div>
    </form>
</div>
<table class="datatables">
    <thead>
        <tr>
            <th># ID</th>
            <th>{{__('admin.user')}}</th>
            <th>{{__('admin.role')}}</th>
            <th>{{__('admin.expires_at')}}</th>
            <th>{{__('admin.created_at')}}</th>
            <th>{{__('text.update')}}</th>
            <th>{{__('text.delete')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($subscriptions as $subscription)
        <tr>
            <form action="{{route('admin.subscriptions.update', $subscription->id)}}" method="POST">
                @csrf
                @method('PUT')
                <td>{{$subscription->id}}</td>
                <td><a href="{{route('profile', $subscription->user)}}">{{$subscription->user->name}}</a></td>
                <td>{{$subscription->role->name}}</td>

                <td><input type="datetime-local" name="expires" class=" @error('expires') is-invalid @enderror" value="{{ date('Y-m-d\TH:i', strtotime($subscription->expires_at)) }}" min="{{date('Y-m-d\TH:i')}}"></td>
                <td>{{$subscription->created_at->diffForHumans()}}</td>
                <td><button type="submit" class="btn btn-success"><i class="fa fa-check"></i></button></td>

            </form>
            <form action="{{route('admin.subscriptions.destroy', $subscription)}}" method="post">
                @csrf
                @method('DELETE')
                <td><button type="submit" class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></td>
            </form>
        </tr>
        @endforeach

    </tbody>
</table>
@stop

