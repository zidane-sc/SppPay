@extends('layouts.app')

@section('title')
    List Jurusan
@endsection

@section('page')
    Data Jurusan
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
    <a href="{{ route('jurusan.trash') }}" class="btn btn-lg btn-primary">Trash</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-7 col-lg-8 col-md-12 col-sm-12">
            <div class="card-box mb-30">
                <div class="pd-20">
                    <h4 class="text-blue h4">Data Jurusan</h4>
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
                                        @can('create-jurusan')
                                            <a href="{{ route('jurusan.edit', [$data->id]) }}" class="btn btn-warning text-white btn-sm">Edit</a>
                                        @endcan

                                        @can('delete-jurusan')
                                        <form onsubmit="return confirm('Move jurusan  to trash?')" action="{{ route('jurusan.destroy', [$data->id]) }}" class="d-inline" method="POST">
                                            @csrf
                                            @method('delete')
                
                                            <input type="submit" class="btn btn-danger btn-sm" value="Trash">
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

        @can('create-jurusan')
        <div class="col-xl-5 col-lg-4 col-md-12 col-sm-12">
            <div class="pd-20 card-box mb-30">
                <div class="clearfix">
                    <div class="pull-left">
                        @if (request()->segment(3) == 'edit')
                            <h4 class="text-blue h4">Form Edit Jurusan</h4>     
                            <p class="mb-30">Ubah data jurusan</p>
                        @else
                            <h4 class="text-blue h4">Form Tambah Jurusan</h4>
                            <p class="mb-30">Tambah data jurusan</p>
                        @endif
                    </div>
                </div>
                <form enctype="multipart/form-data" action="{{ (request()->segment(3) == 'edit') ? route('jurusan.update', $jurusan->id) : route('jurusan.store')  }}" method="POST">
                    @csrf            
                    @if (request()->segment(3) == 'edit')
                        @method('put')                        
                    @endif
    
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input value="{{ old('nama') ?? ($jurusan->nama ?? '') }}"  class="form-control {{ $errors->first('nama') ? 'is-invalid' : '' }}" placeholder="Jurusan" type="text" name="nama" id="nama" />
                        <div class="invalid-feedback">
                            {{ $errors->first('nama') }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi Jurusan"  class="form-control {{$errors->first('deskripsi') ? "is-invalid" : ""}}">{{ old('deskripsi') ?? ($jurusan->deskripsi ?? '')}}</textarea>
                        <div class="invalid-feedback">
                            {{$errors->first('deskripsi')}}
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-info">Save</button>
                    <a href="{{ route('jurusan.index') }}" class="btn btn-secondary">Cancel</a>
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
                    title: 'Success!',
                    text: 'jurusan Successfully added!',
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
                    text: 'jurusan berhasil di update!',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif

    @if (session('trash'))
        <script>
            swal(
                {
                    title: 'Sukses!',
                    text: 'jurusan berhasil di pindahkan ke trash!',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif

    @if (session('restore'))
        <script>
            swal(
                {
                    title: 'Sukses!',
                    text: 'jurusan berhasil di restore!',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif
@endsection