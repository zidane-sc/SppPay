@extends('layouts.app')

@section('title')
    List Trashed Jurusan
@endsection

@section('page')
    Data Trashed Jurusan
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.css') }}">

    <style>
        table{
            padding-top: 10px;
        }
    </style>
@endsection

@section('breadcumb')
    <li class="breadcrumb-item active" aria-current="page">Data Jurusan</li>
@endsection

@section('right-header')
    <a href="{{ route('jurusan.index') }}" class="btn btn-lg btn-primary">Back</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Trashed Jurusan</h4>
                </div>
                <div class="pb-20">
                    <table class="table hover data-table nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus">No</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jurusans as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->deskripsi }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Remove jurusan from trash?')" action="{{ route('jurusan.restore', [$data->id]) }}" class="d-inline" method="POST">
                                            @csrf
                
                                            <input type="submit" class="btn btn-success btn-sm" value="Restore">
                                        </form>
                                        <form onsubmit="return confirm('Delete jurusan permanently?')" action="{{ route('jurusan.delete-permanently', [$data->id]) }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('delete')
                
                                            <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('deskapp/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable Setting js -->
    <script src="{{ asset('deskapp/vendors/scripts/datatable-setting.js') }}"></script>

    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweet-alert.init.js') }}"></script>

    @if (session('delete'))
        <script>
            swal(
                {
                    title: 'Sukses!',
                    text: 'jurusan berhasil di hapus permanent!',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif
    
    @if (session('failed'))
        <script>
            swal(
                {
                    title: 'Gagal!',
                    text: 'jurusan tidak ada di trash!',
                    type: 'error',
                    showCancelButton: false,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif
@endsection