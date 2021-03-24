@extends('layouts.app')

@section('title')
    Profile
@endsection

@section('page')
    Profile User
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.css') }}">
    <style>
        .image{
            display: block;
            margin-bottom: 5px;
        }

        .btn{
            width: 27%;
        }

        .hidden{
            display: none;
        }
    </style>
@endsection

@section('breadcumb')
    <li class="breadcrumb-item active" aria-current="page">Profile User</li>
@endsection

@section('right-header')

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
                <p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
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

        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#setting" role="tab">Change Data</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- Setting Tab start -->
                            <div class="tab-pane fade show active" id="setting" role="tabpanel">
                                <div class="profile-setting">
                                    <form action="{{ route('users.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
                                        @csrf     
                                        @method('put')

                                        <ul class="profile-edit-list row">
                                            <li class="weight-500 col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input value="{{old('name') ? old('name') : $user->name}}" class="form-control {{$errors->first('name') ? "is-invalid" : ""}}" placeholder="Full Name" type="text" name="name" id="name"/>
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('name')}}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input value="{{$user->username}}" disabled class="form-control" placeholder="username" type="text" name="username" id="username"/>
                                                </div>
                                
                                                <div class="form-group hidden">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="weight-600" style="display: block;">Status</label>
                                    
                                                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                                                <input type="radio" id="active" name="status" class="custom-control-input" {{$user->status == "ACTIVE" ? "checked" : ""}}  value="ACTIVE">
                                                                <label class="custom-control-label" for="active">Active</label>
                                                            </div>
                                                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                                                <input type="radio" id="inactive" name="status" class="custom-control-input" {{$user->status == "INACTIVE" ? "checked" : ""}}  value="INACTIVE">
                                                                <label class="custom-control-label" for="inactive">Inactive</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea name="address" id="address" class="form-control {{$errors->first('address') ? "is-invalid" : ""}}">{{old('address') ? old('address') : $user->address}}</textarea>
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('address')}}
                                                    </div>
                                                </div>              
                                                
                                                <div class="form-group">
                                                    <label for="old_password">Old Password</label>
                                                    <input class="form-control {{$errors->first('password') ? "is-invalid" : ""}}" placeholder="old password" type="password" name="old_password" id="old_password"/>
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('old_password')}}
                                                    </div>
                                                </div>

                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <a href="{{ url('/home') }}" class="btn btn-secondary">Back</a>
                                                </div>
                                            </li>
                                            <li class="weight-500 col-md-6">
                                                
                                                <div class="form-group">
                                                    <label for="avatar">Email</label>
                                                    <input value="{{$user->email}}" disabled class="form-control {{$errors->first('email') ? "is-invalid" : ""}} " placeholder="user@mail.com" type="text" name="email" id="email"/>
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('email')}}
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="phone">Phone number</label>
                                                    <input type="text" name="phone" class="form-control {{$errors->first('phone') ? "is-invalid" : ""}}" value="{{old('phone') ? old('phone') : $user->phone}}">
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('phone')}}
                                                    </div>
                                                </div>

                                                <div class="form-group hidden">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="weight-600" style="display: block;">Roles</label>
                                                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                                                <input type="radio" id="customRadio1" name="roles" class="custom-control-input" {{ ($user->roles == 'ADMIN') ? 'checked' : '' }}  value="Admin">
                                                                <label class="custom-control-label" for="customRadio1">Admin</label>
                                                            </div>
                                                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                                                <input type="radio" id="customRadio2" name="roles" class="custom-control-input" {{ ($user->roles == 'STAFF') ? 'checked' : '' }}  value="Staff">
                                                                <label class="custom-control-label" for="customRadio2">Staff</label>
                                                            </div>
                                                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                                                <input type="radio" id="customRadio3" name="roles" class="custom-control-input" {{ ($user->roles == 'GURU') ? 'checked' : '' }}  value="Guru">
                                                                <label class="custom-control-label" for="customRadio3">Guru</label>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                {{$errors->first('roles')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="avatar">Avatar image</label>
                                                    @if($user->avatar)
                                                        <img src="{{asset('storage/'.$user->avatar)}}" width="110px" class="image"/>
                                                    @else
                                                        <img src="{{ asset('deskapp/src/images/no-image.png') }}" class="image"  width="110px">
                                                    @endif
                                
                                                    <div class="custom-file file">
                                                        <input type="file" class="form-control" id="avatar" name="avatar">
                                                        {{-- <label class="custom-file-label">Choose file</label> --}}
                                                    </div>
                                                    <small class="form-text text-muted pt-2">
                                                        Kosongkan jika tidak ingin mengubah gambar    
                                                    </small>
                                                </div>

                                                <div class="form-group">
                                                    <label for="new_password">New Password</label>
                                                    <input class="form-control {{$errors->first('new_password') ? "is-invalid" : ""}}" placeholder="New Password" type="password" name="new_password" id="new_password"/>
                                                    <div class="invalid-feedback">
                                                        {{$errors->first('new_password')}}
                                                    </div>
                                                    <small class="form-text text-muted pt-2">
                                                        Abaikan jika tidak ingin mengubah password    
                                                    </small>
                                                </div>
                                            </li>
                                        </ul>
                                    </form>
                                </div>
                            </div>
                            <!-- Setting Tab End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
<script src="{{ asset('deskapp/src/plugins/sweetalert2/sweet-alert.init.js') }}"></script>

@if (session('failed'))
        <script>
            swal(
                {
                    title: 'Gagal!',
                    text: 'Password lama salah!',
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif
@endsection