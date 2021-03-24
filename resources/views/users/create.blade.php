@extends('layouts.app')

@section('title')
    Add User
@endsection

@section('page')
    Add User
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
    </style>
@endsection

@section('breadcumb')
    <li class="breadcrumb-item active" aria-current="page">Create User</li>
@endsection

@section('content')
        <div class="pd-20 card-box col-md-9 mx-auto mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Form Create User</h4>
                    <p class="mb-30">Tambah user untuk aplikasi SppPay</p>
                </div>
            </div>
            <form enctype="multipart/form-data" action="{{route('users.store')}}" method="POST">
                @csrf              

                <div class="form-group">
                    <label for="name">Name</label>
                    <input value="{{ old('name') }}"  class="form-control {{ $errors->first('name') ? 'is-invalid' : '' }}" placeholder="Full Name" type="text" name="name" id="name" />
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input value="{{ old('username') }}" class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}" placeholder="username" type="text" name="username" id="username" />
                    <div class="invalid-feedback">
                        {{ $errors->first('username') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <label class="weight-600" style="display: block;">Roles</label>
                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                <input type="radio" id="customRadio1" name="roles" class="custom-control-input" {{ (old('roles') == 'Admin') ? 'checked' : '' }} value="Admin">
                                <label class="custom-control-label" for="customRadio1">Admin</label>
                            </div>
                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                <input type="radio" id="customRadio2" name="roles" class="custom-control-input" {{ (old('roles') == 'Staff') ? 'checked' : '' }}  value="Staff">
                                <label class="custom-control-label" for="customRadio2">Staff</label>
                            </div>
                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                <input type="radio" id="customRadio3" name="roles" class="custom-control-input" {{ (old('roles') == 'Guru') ? 'checked' : '' }}  value="Guru">
                                <label class="custom-control-label" for="customRadio3">Guru</label>
                            </div>
                            <div class="small text-danger">
                                {{$errors->first('roles')}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="phone">Phone number</label>
                    <input value="{{old('phone')}}" placeholder="xxxx-xxxx-xxxx"  type="text" name="phone" class="form-control {{$errors->first('phone') ? "is-invalid" : ""}} ">
                    <div class="invalid-feedback">
                        {{$errors->first('phone')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea name="address" id="address" class="form-control {{$errors->first('address') ? "is-invalid" : ""}}">{{old('address')}}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('address')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="avatar">Avatar image</label>
                    <div class="custom-file">
                        <input type="file" class="form-control {{$errors->first('avatar') ? "is-invalid" : ""}}" id="avatar" name="avatar">
                        {{-- <label class="custom-file-label">Choose file</label> --}}
                    </div>
                    <small class="form-text text-muted pt-2">
                        Kosongkan jika tidak ingin menambahkan gambar    
                    </small>
                    <div class="invalid-feedback">
                        {{$errors->first('avatar')}}
                    </div>
                </div>
           

                <div class="form-group">
                    <label for="email">Email</label>
                    <input value="{{old('email')}}" class="form-control {{$errors->first('email') ? "is-invalid" : ""}}" placeholder="user@mail.com"type="text" name="email" id="email"/>
                    <div class="invalid-feedback">
                        {{$errors->first('email')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control {{$errors->first('password') ? "is-invalid" : ""}}" placeholder="password" type="password" name="password" id="password"/>
                    <div class="invalid-feedback">
                        {{$errors->first('password')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Password Confirmation</label>
                    <input class="form-control {{$errors->first('password_confirmation') ? "is-invalid" : ""}}"placeholder="password confirmation" type="password"name="password_confirmation" id="password_confirmation"/>
                    <div class="invalid-feedback">
                        {{$errors->first('password_confirmation')}}
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