@extends('layouts.app')

@section('title')
    List Users
@endsection

@section('page')
    Data Users
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.css') }}">

    <style>
        table{
            padding: 10px;
        }

        .nav-pills {
            float: right;
            padding-right: px;
        }
    </style>
@endsection

@section('breadcumb')
    <li class="breadcrumb-item active" aria-current="page">Data Users</li>
@endsection

@section('right-header')
    <a href="{{ route('users.create') }}" class="btn btn-lg btn-info">Add User</a>
@endsection

@section('content')
    <div class="card-box mb-30">
        <div class="pd-20">
            <div class="row d-flex justify-content-between">
                <div class="col-md-7">
                    {{-- <h4 class="text-blue h4">Tabel User</h4> --}}
                </div>
                <div class="col-md-5">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link {{Request::get('filter') == 'Admin' ? 'active' : '' }}" href="{{route('users.index', ['filter' => 'Admin'])}}">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::get('filter') == 'Staff' ? 'active' : '' }}" href="{{route('users.index', ['filter' => 'Staff'])}}">Staff</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::get('filter') == 'Guru' ? 'active' : '' }}" href="{{route('users.index', ['filter' => 'Guru'])}}">Guru</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{Request::get('filter') == NULL && Request::path() == 'users' ? 'active' : ''}}" href="{{route('users.index')}}">ALL</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="pb-20">
            <table class="table hover multiple-select-row  data-table-export nowrap">
                <thead>
                    <tr>
                        <th class="table-plus">No</th>
                        <th>Avatar</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $user)
                        <tr>
                            <td class="table-plus">{{ $loop->iteration }}</td>
                            <td>
                                @if ($user->avatar)
                                    <img src="{{ asset('storage/'.$user->avatar) }}" width="50px">
                                @else
                                    <img src="{{ asset('deskapp/src/images/no-image.png') }}" width="50px">
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles }}</td>
                            <td>
                                @if ($user->status == 'ACTIVE')
                                    <span class="badge badge-success">
                                        {{ $user->status }}
                                    </span>
                                @else
                                    <span class="badge badge-danger">
                                        {{ $user->status }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-info text-white btn-sm">Edit</a>
                                <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-primary btn-sm">Detail</a>
                                @if ($user->id != Auth::user()->id)
                                <form onsubmit="return confirm('Delete this user permanently?')" action="{{ route('users.destroy', [$user->id]) }}" class="d-inline" method="POST">
                                    @csrf
                                    @method('delete')
        
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('deskapp/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{ asset('deskapp/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>  
    <script src="{{ asset('deskapp/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('deskapp/vendors/scripts/datatable-setting.js') }}"></script>

    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweet-alert.init.js') }}"></script>

    @if (session('create'))
        <script>
            swal(
                {
                    title: 'Sukses!',
                    text: 'User berhasil di tambahkan!',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif

    @if (session('update'))
        <script>
            swal(
                {
                    title: 'Sukses!',
                    text: 'User berhasil di update!',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif

    @if (session('delete'))
        <script>
            swal(
                {
                    title: 'Sukses!',
                    text: 'User berhasil di delete!',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif
@endsection