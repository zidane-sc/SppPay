@extends('layouts.app')

@section('title')
    Show Spp
@endsection

@section('page')
    Detail
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.css') }}">


    <style>
        .image{
            display: block;
            margin-bottom: 5px;
        }

        .nav-item {
            margin-right: auto;
            padding-top: 10px;
            padding-left: 15px;
            width: 100%;
        }

        .tab-pane{
            margin-top: 10px;
        }

        .a100{
            width: 100%;
        }
        
        .btn-1{
            color: blue;
            margin: 10px;
        }

        .btn2{
            color: white;
        }
    </style>
@endsection

@section('breadcumb')
    <li class="breadcrumb-item active" aria-current="page">Detail Spp</li>
@endsection

@section('right-header')
    <a href="{{ route('spp.index') }}" class="btn btn-secondary">Back to table SPP</a>
@endsection
@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <h4 class="text-center h4 mb-0">{{ $spp->nama }}</h4>
                <p class="text-center text-muted font-14">{{ $spp->totalKelas }} Kelas | {{ $spp->totalSiswa }} Siswa</p>
                <div class="profile-info">
                    <h5 class="mb-20 h5 text-blue">Detail Spp</h5>
                    <ul>
                        <li>
                            <span>Nominal:</span>
                            {{ $spp->nominal }}
                        </li>
                        <li>
                            <span>Bulan:</span>
                            {{ date('M Y', strtotime($spp->bulan)) }}
                        </li>
                        <li>
                            <span>Jatuh Tempo:</span>
                            {{ $spp->jatuh_tempo }}
                        </li>
                        <li>
                            <span>Jumlah Kelas:</span>
                            {{ $spp->totalKelas }}
                        </li>
                        <li>
                            <span>Total Siswa:</span>
                            {{ $spp->totalSiswa }}
                        </li>
                        <li>
                            <span>Siswa sudah bayar:</span>
                            {{ $spp->totalSiswaSudahBayar }}
                        </li>
                        <li>
                            <span>Siswa belum bayar:</span>
                            {{ $spp->totalSiswa - $spp->totalSiswaSudahBayar }}
                        </li>
                        <li>
                            <span>Kelas:</span>
                            <ul>
                                @foreach ($spp->kelas as $item)
                                    <ol>{{ $item->nama }}</ol>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 mb-30">
            <div class="card-box height-100-p overflow-hidden">
                <div class="profile-tab height-100-p">
                    <div class="tab height-100-p">
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <div class="row a100">
                                <div class="col-md-6">
                                            <a class="btn btn-1 {{Request::get('status') == 'Bayar' ? 'btn-primary btn2' : '' }}" href="{{route('spp.show', ['status' => 'Bayar', 'spp'=> $spp->id])}}">Bayar</a>
                                            <a class="btn btn-1 {{Request::get('status') == 'Belum' ? 'btn-primary btn2' : '' }}" href="{{route('spp.show', ['status' => 'Belum', 'spp' => $spp->id])}}">Belum</a>
                                            <a class="btn btn-1 {{Request::get('status') == NULL && Request::path() == "spp/$spp->id" ? 'btn-primary btn2' : ''}}" href="{{route('spp.show', $spp->id)}}">ALL</a>
                                </div>
                                <div class="col-md-6">
                                    <li class="nav-item">
                                        <form action="{{route('spp.show', $spp->id)}}">
                                            <div class="input-group">
                                                <select class="selectpicker form-control" name="filter" id="filter"  data-size="5">
                                                    <option disabled selected>Pilih Kelas</option>
                                                    @foreach ($spp->kelas as $item)
                                                        <option data-subtext="{{ $item->wali_kelas }}" value="{{ $item->id }}" {{ (Request::get('filter') == $item->id) ? 'selected' : '' }}>{{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <input type="submit" value="Filter" class="btn btn-primary">
                                                    <a href="{{ route('spp.show', $spp->id) }}" class="btn btn-info">X</a>
                                                </div>
                                            </div>
                                        </form>
                                    </li>
                                </div>
                            </div>
                            
                        </ul>
                        <div class="tab-content">
                            <!-- Setting Tab start -->
                            <div class="tab-pane fade show active" id="setting" role="tabpanel">
                                <div class="profile-setting">
                                    <table class="table hover multiple-select-row  data-table-export nowrap">
                                        <thead>
                                            <tr>
                                                <th>Avatar</th>
                                                <th>Nis</th>
                                                <th>Nama</th>
                                                <th>Status</th>
                                                <th>Kelas</th>
                                                <th>Telepon</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- {{ dd($data) }} --}}
                                            @isset($data['belum'])
                                                @foreach ($data['belum'][0]->kelas as $siswas)
                                                    @foreach ($siswas->siswas as $siswa)
                                                        <tr>
                                                            <td>
                                                                @if ($siswa->avatar)
                                                                    <img src="{{ asset('storage/'.$siswa->avatar) }}" width="50px">
                                                                @else
                                                                    <img src="{{ asset('deskapp/src/images/no-image.png') }}" width="50px">
                                                                @endif
                                                            </td>
                                                            <td>{{ $siswa->nis }}</td>
                                                            <td>{{ $siswa->nama }}</td>
                                                            <td><span class="badge badge-danger">Belum</span></td>
                                                            <td>{{ $siswa->kelas->nama }}</td>
                                                            <td>{{ $siswa->no_telp }}</td>
                                                            <td>
                                                                @can('create-pembayaran')
                                                                    <a href="{{ route('pembayaran.create', ['search' => $siswa->nama, 'id_spp' => $spp->id]) }}" class="btn btn-warning text-white  btn-sm">Lihat</a>
                                                                @endcan
                                                                @cannot('create-pembayaran')
                                                                    <a href="{{ route('pembayaran.create', ['search' => $siswa->nama]) }}" class="btn btn-warning text-white  btn-sm">Lihat</a>
                                                                @endcannot
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endisset

                                            @isset($data['bayar'])
                                                @foreach ($data['bayar'][0]->kelas as $siswas)
                                                    @foreach ($siswas->siswas as $siswa)
                                                        <tr>
                                                            <td>
                                                                @if ($siswa->avatar)
                                                                    <img src="{{ asset('storage/'.$siswa->avatar) }}" width="50px">
                                                                @else
                                                                    <img src="{{ asset('deskapp/src/images/no-image.png') }}" width="50px">
                                                                @endif
                                                            </td>
                                                            <td>{{ $siswa->nis }}</td>
                                                            <td>{{ $siswa->nama }}</td>
                                                            <td><span class="badge badge-success">Bayar</span></td>
                                                            <td>{{ $siswa->kelas->nama }}</td>
                                                            <td>{{ $siswa->no_telp }}</td>
                                                            <td>
                                                                @can('create-pembayaran')
                                                                    <a href="{{ route('pembayaran.create', ['search' => $siswa->nama, 'id_spp' => $spp->id]) }}" class="btn btn-warning text-white  btn-sm">Lihat</a>
                                                                @endcan
                                                                @cannot('create-pembayaran')
                                                                    <a href="{{ route('pembayaran.create', ['search' => $siswa->nama]) }}" class="btn btn-warning text-white  btn-sm">Lihat</a>
                                                                @endcannot
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
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
    <script src="{{ asset('deskapp/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweet-alert.init.js') }}"></script>

    <!-- Datatable Setting js -->
    <script src="{{ asset('deskapp/vendors/scripts/datatable-setting.js') }}"></script>

    @if (session('bayar'))
        <script>
            swal(
                {
                    title: 'Success!',
                    text: 'Spp telah dibayar!',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif
@endsection