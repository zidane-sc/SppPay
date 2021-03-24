@extends('layouts.app')

@section('title')
    Laporan Siswa
@endsection

@section('page')
    Laporan Siswa
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
    <li class="breadcrumb-item active" aria-current="page">laporan siswa</li>
@endsection

@section('right-header')
    {{-- <a href="{{ route('siswa.create') }}" class="btn btn-lg btn-info">Add Siswa</a> --}}
@endsection

@section('content')
    <div class="page-header" style="background: #6209AB!important;">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                {{-- <h3 class="text-white"></h3> --}}
                <a href="{{ route('laporan.siswa_cetak', ['filter' => Request::get('filter')]) }}" class="btn btn-danger">Cetak</a>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <div class="dropdown">
                    <a class="btn btn-warning dropdown-toggle" href="{{ route('laporan.siswa') }}" role="button" data-toggle="dropdown">
                        Pilih Kelas
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('laporan.siswa', ['laporan' => 'siswa']) }}">Semua Kelas</a>
                        @foreach ($data['kelas'] as $item)
                            {{-- <option data-subtext="{{ $item->wali_kelas }}" value="{{ $item->id }}" {{ (Request::get('filter') == $item->id) ? 'selected' : '' }}>{{ $item->nama }}</option> --}}
                            <a class="dropdown-item" href="{{ route('laporan.siswa', ['laporan' => 'siswa', 'filter' => $item->id]) }}">{{ $item->nama }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-box mb-30">
        <div class="pd-20">
        </div>
        <div class="pb-20">
            <table class="table stripe multiple-select-row nowrap">
                <thead>
                    <tr>
                        <th class="table-plus">No</th>
                        <th>Nis</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['main'] as $siswa)
                        <tr>
                            <td class="table-plus">{{ $loop->iteration }}</td>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->kelas->nama }}</td>
                            <td>{{ $siswa->no_telp }}</td>
                            <td>{{ Str::limit($siswa->alamat, 30, '...') }}</td>
                            <td>{{ $siswa->jenis_kelamin }}</td>
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

    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweet-alert.init.js') }}"></script>

    @if (session('create'))
        <script>
            swal(
                {
                    title: 'Success!',
                    text: 'Siswa Successfully added!',
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
                    title: 'Success!',
                    text: 'User Successfully updated!',
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
                    title: 'Success!',
                    text: 'User Successfully deleted!',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif
@endsection