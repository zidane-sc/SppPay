@extends('layouts.app')

@section('title')
    Home
@endsection

@section('page')
    Dashboard
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.css') }}">
@endsection

@section('breadcumb')
    {{-- <li class="breadcrumb-item active" aria-current="page">blank</li> --}}
@endsection

@section('content')
    <div class="card-box pd-20 height-150-p mx-auto mb-30">
        <div class="row">
            <div class="align-items-center row">
                <div class="col-md-4">
                    <img src="{{ asset('deskapp/vendors/images/banner-img.png') }}" alt="">
                </div>
                <div class="col-md-8">
                    <h4 class="font-30 weight-500 mb-10 text-capitalize">
                        Selamat Datang <div class="weight-600 font-50 text-blue">{{ Auth::user()->name }}!</div>
                    </h4>
                    <p class="font-18 max-width-600">{{ date('D-M-Y') }}.</p>
                    <a href="{{ route('siswa.index') }}" class="btn btn-primary">Lihat Siswa</a>
                    <a href="{{ route('kelas.index') }}" class="btn btn-warning text-white">Lihat Kelas</a>
                    <a href="{{ route('jurusan.index') }}" class="btn btn-danger">Lihat Jurusan</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart"></div>
                    </div>
                    <div class="widget-data">
                    <div class="h4 mb-0">{{ $data['user'] }}</div>
                        <div class="weight-600 font-14">Users</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart2"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">{{ $data['jurusan']  }}</div>
                        <div class="weight-600 font-14">Jurusan</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart3"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">{{ $data['kelas'] }}</div>
                        <div class="weight-600 font-14">Kelas</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 mb-30">
            <div class="card-box height-100-p widget-style1">
                <div class="d-flex flex-wrap align-items-center">
                    <div class="progress-data">
                        <div id="chart4"></div>
                    </div>
                    <div class="widget-data">
                        <div class="h4 mb-0">{{ $data['siswa'] }}</div>
                        <div class="weight-600 font-14">Siswa</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('deskapp/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweet-alert.init.js') }}"></script>
	<script src="{{ asset('deskapp/vendors/scripts/dashboard.js') }}"></script>

    @if (session('sukses'))
        <script>
            swal(
                {
                    title: 'Sukses!',
                    text: 'Database berhasil di backup!, lihat di folder storage/app/Laravel',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif
@endsection