@extends('layouts.app')

@section('title')
    List Spp
@endsection

@section('page')
    Data Spp
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css') }}">

    <style>
        table{
            padding-top: 10px;
        }
    </style>
@endsection

@section('breadcumb')
    <li class="breadcrumb-item active" aria-current="page">Data Kelas</li>
@endsection

@section('right-header')
    {{-- <a href="{{ route('jurusan.trash') }}" class="btn btn-lg btn-primary">Trash</a> --}}
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <div class="row d-flex justify-content-between">
                        {{-- <div class="col-md-7">
                            <h4 class="text-blue h4">Data Kelas</h4>
                        </div>
                        <div class="col-md-5">
                            <ul class="nav nav-pills card-header-pills">
                                <li class="nav-item">
                                    <a class="nav-link {{Request::get('filter') == 'X' ? 'active' : '' }}" href="{{route('kelas.index', ['filter' => 'X'])}}">X</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{Request::get('filter') == 'XI' ? 'active' : '' }}" href="{{route('kelas.index', ['filter' => 'XI'])}}">XI</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{Request::get('filter') == 'XII' ? 'active' : '' }}" href="{{route('kelas.index', ['filter' => 'XII'])}}">XII</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{Request::get('filter') == NULL && Request::path() == 'kelas' ? 'active' : ''}}" href="{{route('kelas.index')}}">ALL</a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                <div class="pb-20">
                    <table class="table hover data-table nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus">No</th>
                                <th>Nama</th>
                                <th>Bulan</th>
                                <th>Nominal</th>
                                <th>Jatuh Tempo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($spps as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ date('M Y', strtotime($data->bulan)) }}</td>
                                    <td>Rp. {{ number_format($data->nominal) }}</td>
                                    <td>{{ $data->jatuh_tempo }}</td>
                                    <td>
                                        @can('create-pembayaran')
                                            <a href="{{ route('spp.edit', [$data->id]) }}" class="btn btn-info text-white btn-sm">Edit</a>  
                                        @endcan
                                        <a href="{{ route('spp.show', [$data->id]) }}" class="btn btn-primary btn-sm">Detail</a>
                                        @can('create-pembayaran')
                                        <form onsubmit="return confirm('Delete this spp permanently?')" action="{{ route('spp.destroy', [$data->id]) }}" class="d-inline" method="POST">
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
        </div>

        @can('create-pembayaran')
        <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        @if (request()->segment(3) == 'edit')
                            <h4 class="text-blue h4">Form Edit Spp</h4>                        
                            <p class="mb-30">Edit SPP</p>
                        @else
                            <h4 class="text-blue h4">Form Add Spp</h4>
                            <p class="mb-30">Tambah SPP</p>
                        @endif
                    </div>
                </div>
                <form enctype="multipart/form-data" action="{{ (request()->segment(3) == 'edit') ? route('spp.update', $spp->id) : route('spp.store')  }}" method="POST">
                    @csrf            
                    @if (request()->segment(3) == 'edit')
                        @method('put')                        
                    @endif
    
                    <div class="form-group">
                        <label for="nama">Nama Spp</label>
                        <input value="{{ old('nama') ?? ($spp->nama ?? "") }}"  class="form-control {{ $errors->first('nama') ? 'is-invalid' : '' }}" placeholder="SPP (kelas) (jurusan) (bulan)" type="text" name="nama" id="nama" />
                        <div class="invalid-feedback">
                            {{ $errors->first('nama') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nominal</label>
                        <input id="nominal" type="text" placeholder="0" name="nominal" value="{{ old('nominal') ?? ($spp->nominal ?? "") }}">
                        <div class="invalid-feedback">
                            {{ $errors->first('nominal') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <input value="{{ old('bulan') ?? (date('M Y', strtotime($spp->bulan ?? "today"))) }}" class="form-control month-picker {{ $errors->first('nominal') ? 'is-invalid' : '' }}" id="bulan" name="bulan"  placeholder="Pilih Bulan" type="text">
                        <div class="invalid-feedback">
                            {{ $errors->first('bulan') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jatuh_tempo">Jatuh Tempo</label>
                        <input value="{{ old('jatuh_tempo') ?? ($spp->jatuh_tempo ?? "") }}"  class="form-control date-picker {{ $errors->first('nominal') ? 'is-invalid' : '' }}" placeholder="Pilih Tanggal" type="text" name="jatuh_tempo" id="jatuh_tempo">
                        <div class="invalid-feedback">
                            {{ $errors->first('jatuh_tempo') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="kelas_id">Untuk Kelas</label>
                        <select class="custom-select2 form-control" multiple="multiple" name="kelas_id[]">
                            @isset($spp)
                                @foreach ($spp->kelas as $item)
                                    <option data-subtext="{{ $item->wali_kelas }}" value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                                @endforeach
                            @endisset
                            @foreach ($kelas as $item)
                                <option data-subtext="{{ $item->wali_kelas }}" value="{{ $item->id }}" {{ (old('kelas_id') == $item->id) ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('kelas_id') }}
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-info">Save</button>
                    <a href="{{ route('spp.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
                
            <div class="collapse-box collapse show" id="horizontal-basic-form1" style="">
        </div>
        @endcan 
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

    <!-- bootstrap-touchspin js -->
	<script src="{{ asset('deskapp/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
	<script>
        $("input[name='nominal']").TouchSpin({
			min: -1000000000,
			max: 1000000000,
			stepinterval: 1000,
            step: 50000,
			maxboostedstep: 100,
			prefix: 'Rp'
		});
    </script>

    @if (session('create'))
        <script>
            swal(
                {
                    title: 'Sukses!',
                    text: 'spp Successfully added!',
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
                    text: 'spp berhasil diupdate!',
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
                    text: 'spp Sudah ada!',
                    type: 'error',
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
                    text: 'spp berhasil dihapus!',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif
@endsection