@extends('layouts.app')

@section('title')
    Edit User
@endsection

@section('page')
    Edit User
@endsection

@section('style')
    <style>
        label{
            margin-top: 8px;
        }

        .btn{
            margin-top: 20px;
            width: 100px;
        }

        .file{
            margin-top: 10px;
        }

        .image{
            display: block;
        }
    </style>
@endsection

@section('breadcumb')
    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
@endsection

@section('content')
        <div class="pd-20 card-box col-md-9 mx-auto mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Form Edit User</h4>
                    <p class="mb-30">Ubah data users</p>
                </div>
            </div>
            
            <form action="{{ route('users.update', [$user->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf     
                @method('put')         

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

                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <label class="weight-600" style="display: block;">Status</label>
    
                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                <input type="radio" id="active" name="status" class="custom-control-input" {{( old('status') ?? $user->status) == "ACTIVE" ? "checked" : ""}}  value="ACTIVE">
                                <label class="custom-control-label" for="active">Active</label>
                            </div>
                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                <input type="radio" id="inactive" name="status" class="custom-control-input" {{(old('status') ?? $user->status) == "INACTIVE" ? "checked" : ""}}  value="INACTIVE">
                                <label class="custom-control-label" for="inactive">Inactive</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <label class="weight-600" style="display: block;">Roles</label>
                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                <input type="radio" id="customRadio1" name="roles" class="custom-control-input" {{(old('roles') ?? $user->roles) == "ADMIN" ? "checked" : ""}}  value="ADMIN">
                                <label class="custom-control-label" for="customRadio1">Admin</label>
                            </div>
                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                <input type="radio" id="customRadio2" name="roles" class="custom-control-input" {{(old('roles') ?? $user->roles) == "STAFF" ? "checked" : ""}}  value="STAFF">
                                <label class="custom-control-label" for="customRadio2">Staff</label>
                            </div>
                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                <input type="radio" id="customRadio3" name="roles" class="custom-control-input" {{(old('roles') ?? $user->roles) == "GURU" ? "checked" : ""}}  value="GURU">
                                <label class="custom-control-label" for="customRadio3">Guru</label>
                            </div>
                            <div class="invalid-feedback">
                                {{$errors->first('roles')}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone number</label>
                    <input type="text" name="phone" class="form-control {{$errors->first('phone') ? "is-invalid" : ""}}" value="{{old('phone') ? old('phone') : $user->phone}}">
                    <div class="invalid-feedback">
                        {{$errors->first('phone')}}
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
                    <label for="avatar">Email</label>
                    <input value="{{$user->email}}" disabled class="form-control {{$errors->first('email') ? "is-invalid" : ""}} " placeholder="user@mail.com" type="text" name="email" id="email"/>
                    <div class="invalid-feedback">
                        {{$errors->first('email')}}
                    </div>
                </div>
               
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
            </form>
            
        <div class="collapse-box collapse show" id="horizontal-basic-form1" style="">
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweet-alert.init.js') }}"></script>

    @if (session('status'))
        <script>
            swal(
                {
                    title: 'Success!',
                    text: 'User Successfully added!',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif

@endsection