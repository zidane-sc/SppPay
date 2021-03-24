@extends('layouts.app')

@section('title')
    Laporan Spp
@endsection

@section('page')
    Laporan Spp
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
    <li class="breadcrumb-item active" aria-current="page">laporan Spp</li>
@endsection

@section('right-header')
    {{-- <a href="{{ route('siswa.create') }}" class="btn btn-lg btn-info">Add Siswa</a> --}}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-2">
            <div class="page-header" style="background: #6209AB!important; height: 85px!important;">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <a href="{{ route('laporan.spp_cetak', ['filter' => Request::get('filter')]) }}" class="btn btn-danger btn-lg w-100">Cetak</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-1">

        </div>
        <div class="col-md-3">
            {{-- <div class="page-header" style="background: #6209AB!important; height: 85px!important;">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <h1 class="text-white">Data Siswa</h1>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="col-md-1">

        </div>
        <div class="col-md-5">
            <div class="page-header" style="background: #6209AB!important; height: 85px!important;">
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-right">
                        <div class="form-group row">
							<div class="col-sm-8 col-md-8">
                                <input class="form-control month-picker" id="selectDate" value="{{ Request::get('filter') }}"  placeholder="Select Month" type="text">
                            </div>
                            <div class="col-sm-2 col-md-2">
                                {{-- <a href="{{ route('laporan.spp', 'filter' => ) }}" class="btn btn-info btn-lg">Cari</a> --}}
                                <button onclick="submitDate()" class="btn btn-info btn-lg">Cari</button>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <a href="{{ route('laporan.spp') }}"  class="btn btn-warning btn-lg">All</a>
                            </div>
						</div>
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
                        <th>Nama</th>
                        <th>Bulan</th>
                        <th>Nominal</th>
                        <th>Jatuh Tempo</th>
                        <th>Jumlah Kelas</th>
                        <th>Total Siswa</th>
                        <th>Bayar</th>
                        <th>Belum</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['main'] as $spp)
                        <tr>
                            <td class="table-plus">{{ $loop->iteration }}</td>
                            <td>{{ $spp->nama }}</td>
                            <td>{{ date('M Y', strtotime($spp->bulan)) }}</td>
                            <td>{{ $spp->nominal }}</td>
                            <td>{{ $spp->jatuh_tempo }}</td>
                            <td>{{ $spp->totalKelas }} Kelas</td>
                            <td>{{ $spp->totalSiswa }} Siswa</td>
                            <td>{{ $spp->totalSiswaSudahBayar }} Siswa</td>
                            <td>{{ $spp->totalSiswa - $spp->totalSiswaSudahBayar }} Siswa</td>
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
    {{-- <script src="{{ asset('deskapp/vendors/scripts/datatable-setting.js') }}"></script> --}}

    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweet-alert.init.js') }}"></script>

    <script>
        function submitDate() {
            test = $('#selectDate').val();
            // alert(test)
            url = '{{ route('laporan.spp') }}';
            window.location.replace(url + '?filter='  + test);
        }
    </script>

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