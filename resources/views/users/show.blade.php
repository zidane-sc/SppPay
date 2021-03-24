@extends('layouts.app')

@section('title')
    Show
@endsection

@section('page')
    Detail Users
@endsection

@section('style')
    
@endsection

@section('breadcumb')
    <li class="breadcrumb-item active" aria-current="page">Detail User</li>
@endsection

@section('right-header')
    <a href="{{ route('users.index') }}" class="btn btn-lg btn-secondary">Back to table user</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-4 mx-auto  col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    @if($user->avatar)
                        <img src="{{asset('storage/'. $user->avatar)}}" class="avatar-photo mx-auto"  width="160px"/>
                    @else
                        <img src="{{ asset('deskapp/src/images/no-image.png') }}" class="avatar-photo mx-auto"  width="160px">
                    @endif
                </div>
                <h5 class="text-center h5 mb-0">{{ $user->username }}</h5>
                <p class="text-center text-muted font-14">{{ $user->status }} | {{ $user->roles }}</p>
                <div class="profile-info">
                    <h5 class="mb-20 h5 text-blue">Detail Information</h5>
                    <ul>
                        <li>
                            <span>Name:</span>
                            {{ $user->name }}
                        </li>
                        <li>
                            <span>Email Address:</span>
                            {{ $user->email }}
                        </li>
                        <li>
                            <span>Phone Number:</span>
                            {{ $user->phone }}
                        </li>
                        <li>
                            <span>Roles:</span>
                            {{ $user->roles }}
                        </li>
                        <li>
                            <span>Address:</span>
                            {{ $user->address }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection