@extends('layouts.app')

@section('title')
    List Kelas
@endsection

@section('page')
    Data Kelas
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.css') }}">

    <style>
        table{
            padding-top: 10px;
        }

        .nav-pills {
            float: right;
            padding-right: 5px;
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
                        <div class="col-md-7">
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
                        </div>
                    </div>
                </div>
                <div class="pb-20">
                    <table class="table hover data-table nowrap">
                        <thead>
                            <tr>
                                <th class="table-plus">No</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Wali Kelas</th>
                                <th>Siswa</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->jurusan->nama }}</td>
                                    <td>{{ $data->wali_kelas }}</td>
                                    <td>{{ $data->totalSiswa }}</td>
                                    <td>
                                        @can('create-kelas')
                                            <a href="{{ route('kelas.edit', [$data->id]) }}" class="btn btn-warning text-white btn-sm">Edit</a>
                                        @endcan
                                        @can('delete-kelas')
                                        <form onsubmit="return confirm('Delete kelas permanently?')" action="{{ route('kelas.destroy', [$data->id]) }}" class="d-inline" method="POST">
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

        @can('create-kelas')
            <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        @if (request()->segment(3) == 'edit')
                            <h4 class="text-blue h4">Form Edit kelas</h4>                        
                            <p class="mb-30">Ubah data kelas</p>
                        @else
                            <h4 class="text-blue h4">Form Tambah kelas</h4>
                            <p class="mb-30">Tambah data kelas</p>
                        @endif
                    </div>
                </div>
                <form enctype="multipart/form-data" action="{{ (request()->segment(3) == 'edit') ? route('kelas.update', $kelas->id) : route('kelas.store')  }}" method="POST">
                    @csrf            
                    @if (request()->segment(3) == 'edit')
                        @method('put')                        
                    @endif
    
                    <div class="form-group">
                        <label for="wali_kelas">Wali Kelas</label>
                        <input value="{{ old('wali_kelas') ?? ($kelas->wali_kelas ?? "") }}"  class="form-control {{ $errors->first('wali_kelas') ? 'is-invalid' : '' }}" placeholder="Wali Kelas" type="text" name="wali_kelas" id="wali_kelas" />
                        <div class="invalid-feedback">
                            {{ $errors->first('wali_kelas') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label class="weight-600" style="display: block;">Tingkat</label>
                                <div class="custom-control custom-radio mr-2" style="display: inline;">
                                    <input type="radio" id="customRadio1" name="tingkat" class="custom-control-input" {{(old('tingkat') ?? ($kelas->tingkat ?? "")) == "X" ? "checked" : ""}}  value="X">
                                    <label class="custom-control-label" for="customRadio1">X</label>
                                </div>
                                <div class="custom-control custom-radio mr-2" style="display: inline;">
                                    <input type="radio" id="customRadio2" name="tingkat" class="custom-control-input" {{(old('tingkat') ??($kelas->tingkat ?? "")) == "XI" ? "checked" : ""}}  value="XI">
                                    <label class="custom-control-label" for="customRadio2">XI</label>
                                </div>
                                <div class="custom-control custom-radio mr-2" style="display: inline;">
                                    <input type="radio" id="customRadio3" name="tingkat" class="custom-control-input" {{(old('tingkat') ??($kelas->tingkat ?? "")) == "XII" ? "checked" : ""}}  value="XII">
                                    <label class="custom-control-label" for="customRadio3">XII</label>
                                </div>
                                <div class="small text-danger">
                                    {{$errors->first('tingkat')}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="no">No Kelas</label>
                        <input value="{{ old('no') ??  ($kelas->no ?? "") }}"  class="form-control {{ $errors->first('no') ? 'is-invalid' : '' }}" placeholder="Nomer" type="number" name="no" id="no" />
                        <div class="invalid-feedback">
                            {{ $errors->first('no') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Jurusan</label>
                        <select class="selectpicker form-control {{ $errors->first('jurusan_id') ? 'is-invalid' : '' }}" name="jurusan_id" id="jurusan_id"  data-size="5">
                                <option disabled selected>Pilih Jurusan</option>
                            @foreach ($jurusan as $item)
                                <option data-subtext="{{ $item->deskripsi }}" value="{{ $item->id }}" {{ (( old('jurusan_id') ?? ($kelas->jurusan_id ?? "")) == $item->id) ? 'selected' : '' }}>{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('jurusan_id') }}
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-info">Save</button>
                    <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Cancel</a>
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

    @if (session('create'))
        <script>
            swal(
                {
                    title: 'Sukses!',
                    text: 'kelas Berhasil ditambahkan!',
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
                    text: 'Kelas berhasil di update!',
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
                    text: 'Kelas Sudah ada!',
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
                    text: 'kelas berhasil di delete!',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif
@endsection