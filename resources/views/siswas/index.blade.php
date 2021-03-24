@extends('layouts.app')

@section('title')
    List Siswa
@endsection

@section('page')
    Data Siswa
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
    <li class="breadcrumb-item active" aria-current="page">Data Siswa</li>
@endsection

@section('right-header')
    <a href="{{ route('siswa.create') }}" class="btn btn-lg btn-info">Add Siswa</a>
@endsection

@section('content')
    <div class="card-box mb-30">
        <div class="pd-20">
            <div class="row d-flex justify-content-between">
                <div class="col-md-7">
                    <h4 class="text-blue h4">Tabel Siswa</h4>
                </div>
                <div class="col-md-5">
                    <form action="{{route('siswa.index')}}">
                        <div class="input-group">
                            <select class="selectpicker form-control" name="filter" id="filter"  data-size="5">
                                <option disabled selected>Pilih Kelas</option>
                                @foreach ($kelas as $item)
                                    <option data-subtext="{{ $item->wali_kelas }}" value="{{ $item->id }}" {{ (Request::get('filter') == $item->id) ? 'selected' : '' }}>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <input type="submit" value="Filter" class="btn btn-primary">
                                <a href="{{ url('/siswa') }}" class="btn btn-secondary text-white">X</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="pb-20">
            <table class="table hover multiple-select-row  data-table-export nowrap">
                <thead>
                    <tr>
                        <th class="table-plus">No</th>
                        <th>Avatar</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswas as $siswa)
                        <tr>
                            <td class="table-plus">{{ $loop->iteration }}</td>
                            <td>
                                @if ($siswa->avatar)
                                    <img src="{{ asset('storage/'.$siswa->avatar) }}" width="50px">
                                @else
                                    <img src="{{ asset('deskapp/src/images/no-image.png') }}" width="50px">
                                @endif
                            </td>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->kelas->nama }}</td>
                            <td>{{ $siswa->no_telp }}</td>
                            <td>{{ Str::limit($siswa->alamat, 30, '...') }}</td>
                            <td>{{ $siswa->jenis_kelamin }}</td>
                            <td>
                                @can('update-siswa')
                                    <a href="{{ route('siswa.edit', [$siswa->id]) }}" class="btn btn-info text-white btn-sm">Edit</a>
                                @endcan
                                <a href="{{ route('siswa.show', [$siswa->id]) }}" class="btn btn-primary btn-sm">Detail</a>
                                @can('delete-siswa')
                                <form onsubmit="return confirm('Delete this siswa permanently?')" action="{{ route('siswa.destroy', [$siswa->id]) }}" class="d-inline" method="POST">
                                    @csrf
                                    @method('delete')
        
                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete">
                                </form>
                                @endcan
                                
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
                    text: 'Siswa berhasil ditambahkan!',
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
                    text: 'Siswa berhasil di update!',
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
                    text: 'Siswa berhasil di delete!',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif
@endsection