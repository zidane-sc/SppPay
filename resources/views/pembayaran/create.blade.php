@extends('layouts.app')

@section('title')
    Bayar Spp
@endsection

@section('page')
    Pembayaran
@endsection

@section('style')

    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.css') }}">

    <style>
        .h3{
            margin-top: 20px;
        }

        .image{
            display: block;
            margin-bottom: 5px;
        }

        .btn{
            width: 100%;
        }

        .nama{
            margin-top: 20px;
        }
        
        .hidden{
            visibility: hidden;
        }

        .mt-20{
            margin-top: 20px;
        }

        input[name="nominal"] {
            margin-bottom: 25px;
        }
    </style>
@endsection

@section('breadcumb')
    <li class="breadcrumb-item active" aria-current="page">Pembayaran SPP</li>
@endsection

@section('right-header')

@endsection

@section('content')

    <div class="search-icon-box bg-white box-shadow border-radius-10 mb-30">
        <input id="search" name="search" type="text" name="box22" value="{{ Request::get('search') }}"  placeholder="Cari Siswa" class="border-radius-10" onkeypress="handle(event)"/>
        <i class="search_icon dw dw-search"></i>
    </div>
    <div class="row">
        @if(isset($data['siswa']))
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 mb-30">
                <div class="card-box height-100-p overflow-hidden">
                    <div class="profile-tab height-100-p">
                        <div class="tab height-100-p">
                            <div class="tab-content">
                                <!-- Setting Tab start -->
                                <div class="tab-pane fade show active" id="setting" role="tabpanel">
                                    <div class="profile-setting">
                                        <h3 class="text-center h3 text-blue">Informasi siswa</h3>
                                        <div class="profile-photo">
                                            @if($data['siswa']->avatar)
                                                <img src="{{asset('storage/'. $data['siswa']->avatar)}}" class="avatar-photo mx-auto"  width="160px"/>
                                            @else
                                                <img src="{{ asset('deskapp/src/images/no-image.png') }}" class="avatar-photo mx-auto"  width="160px">
                                            @endif
                                        </div>

                                        <h5 class="text-center h5 mb-0">{{ $data['siswa']->nis }}</h5>
                                        <p class="text-center text-muted font-14">{{ $data['siswa']->kelas->jurusan->deskripsi }}</p>

                                        <ul class="profile-edit-list row mt-0">
                                            <li class="weight-500 col-md-6">
                                                <div class="profile-info">
                                                    <ul>
                                                        <div class="profile-info">
                                                            <li>
                                                                <span>Nama:</span>
                                                                {{ $data['siswa']->nama }}
                                                            </li>
                                                            <li>
                                                                <span>Kelas:</span>
                                                                {{ $data['siswa']->kelas->nama }}
                                                            </li>
                                                            <li>
                                                                <span>Jurusan:</span>
                                                                {{ $data['siswa']->kelas->jurusan->nama }} ( {{ $data['siswa']->kelas->jurusan->deskripsi }} )
                                                            </li>
                                                            <li>
                                                                <span>Jenis Kelamin:</span>
                                                                {{ $data['siswa']->jenis_kelamin }}
                                                            </li>
                                                            <li>
                                                                <span>No Telepon:</span>
                                                                {{ $data['siswa']->no_telp }}
                                                            </li>
                                                            <li>
                                                                <span>Alamat:</span>
                                                                {{ $data['siswa']->alamat }}
                                                            </li>
                                                        </div>
                                                    </ul>
                                                </div>
                                            </li>
                                            <li class="weight-500 col-md-6">
                                                <div class="profile-info">
                                                    <ul>
                                                        <div class="profile-info">
                                                            <li>
                                                                <span>Tempat Lahir:</span>
                                                                {{ $data['siswa']->tempat_lahir }}
                                                            </li>
                                                            <li>
                                                                <span>Tanggal Lahir:</span>
                                                                {{ $data['siswa']->tanggal_lahir }}
                                                            </li>
                                                            <li>
                                                                <span>Nama Ayah:</span>
                                                                {{ $data['siswa']->nama_ayah }}
                                                            </li>
                                                            <li>
                                                                <span>Pekerjaan Ayah:</span>
                                                                {{ $data['siswa']->pekerjaan_ayah }}
                                                            </li>
                                                            <li>
                                                                <span>Nama Ibu:</span>
                                                                {{ $data['siswa']->nama_ibu }}
                                                            </li>
                                                            <li>
                                                                <span>Pekerjaan Ibu:</span>
                                                                {{ $data['siswa']->pekerjaan_ibu }}
                                                            </li>
                                                        </div>
                                                    </ul>
                                                </div>  
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Setting Tab End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-7 mx-auto  col-lg-7 col-md-7 col-sm-12 mb-30">
                <div class="row">
                    <div class="col-md-12">
                        <div class="pd-20 card-box height-100-p">
                            <h3 class="h3 m-0 mb-5 text-blue">Pilih Pembayaran</h3>
                            <table class="table hover data-table nowrap">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        {{-- <th>Bulan</th> --}}
                                        <th>Nominal</th>
                                        <th>Jatuh Tempo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($data['spps'][0]->spps as $item)
                                        <tr>
                                            <td>{{ $item->nama }}</td>
                                            <td><span class="badge badge-success">Lunas</span></td>
                                            {{-- <td>{{ date('M Y', strtotime($item->bulan)) }}</td> --}}
                                            <td>Rp. {{ number_format($item->nominal) }}</td>
                                            <td>{{ $item->jatuh_tempo }}</td>
                                            <td>
                                                <a href="{{ route('pembayaran.show', [$item->id, 'id' => $data['siswa']->id, 'idspp' => $item->id]) }}" class="btn btn-warning text-white btn-sm">Bukti</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    @foreach ($data['spps'][0]->kelas->spps as $spps)
                                        <tr>
                                            @foreach ($data['spps'][0]->spps as $items)
                                                @if ($spps->id == $items->id)
                                                    @continue(2)
                                                @endif                                                
                                            @endforeach

                                            <td>{{ $spps->nama }}</td>
                                            <td><span class="badge badge-danger">Belum</span></td>
                                            {{-- <td>{{ date('M Y', strtotime($spps->bulan)) }}</td> --}}
                                            <td>Rp. {{ number_format($spps->nominal) }}</td>
                                            <td>{{ $spps->jatuh_tempo }}</td>
                                            <td>
                                                @can('create-pembayaran')
                                                    <a href="{{ route('pembayaran.create', ['search' => Request::get('search'), 'id_spp' => $spps->id]) }}" class="btn btn-warning text-white btn-sm">Bayar</a>
                                                @endcan
                                                @cannot('create-pembayaran')
                                                    <a href="{{ route('pembayaran.create', ['search' => Request::get('search')]) }}" class="btn btn-secondary btn-sm" style="cursor:not-allowed;">Bayar</a>
                                                @endcannot
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @can('create-pembayaran', Model::class)
                    @isset($data['spp'])
                    <div class="col-md-12 mt-20">
                        <div class="pd-20 card-box height-100-p">
                            <h3 class="h3 m-0 mb-5 text-blue">Form Pembayaran</h3>
                            <form action="{{ route('pembayaran.store', ['search' => Request::get('search')]) }}" method="POST" enctype="multipart/form-data">
                                @csrf     
                                <input type="text" class="hidden"  name="siswa_id" value="{{ $data['siswa']->id }}">
                                <input type="text" class="hidden"  name="spp_id" value="{{ $data['spp']->id }}">


                                <ul class="profile-edit-list row">
                                    <li class="weight-500 col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama SPP</label>
                                            <input value="{{old('nama') ? old('nama') : $data['spp']->nama}}" readonly  class="form-control {{$errors->first('nama') ? "is-invalid" : ""}}" placeholder="" type="text" name="nama" id="nama"/>
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="bulan">Bulan</label>
                                            <input readonly value="{{ old('bulan') ?? (date('M Y', strtotime($data['spp']->bulan ?? "today"))) }}" class="form-control month-picker {{ $errors->first('nominal') ? 'is-invalid' : '' }}" id="bulan" name="bulan"  placeholder="Pilih Bulan" type="text">
                                        </div>

                                        <div class="form-group">
                                            <label for="jatuh_tempo">Jatuh Tempo</label>
                                            <input readonly value="{{ old('jatuh_tempo') ?? ($data['spp']->jatuh_tempo ?? "") }}"  class="form-control date-picker {{ $errors->first('nominal') ? 'is-invalid' : '' }}" placeholder="Pilih Tanggal" type="text" name="jatuh_tempo" id="jatuh_tempo">
                                        </div>

                                        <div class="form-group">
                                            <label>Nominal</label>
                                            <input id="nominal" class="form-control" readonly  type="text" placeholder="0" name="nominal" value="{{ old('nominal') ?? ($data['spp']->nominal ?? "") }}">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </li>
                                    <li class="weight-500 col-md-6">
                                        <div class="form-group">
                                            <label for="nama">Nama Petugas</label>
                                            <input value="{{old('nama') ? old('nama') : Auth::user()->name}}" readonly  class="form-control {{$errors->first('nama') ? "is-invalid" : ""}}" placeholder="" type="text" name="nama" id="nama"/>
                                        </div>

                                        <div class="form-group">
                                            <label for="nama">Nama Siswa</label>
                                            <input value="{{old('nama') ? old('nama') : $data['siswa']->nama}}" readonly  class="form-control {{$errors->first('nama') ? "is-invalid" : ""}}" placeholder="" type="text" name="nama" id="nama"/>
                                        </div>
                        
                                        <div class="form-group">
                                            <label for="nama">Kelas</label>
                                            <input value="{{old('nama') ? old('nama') : $data['siswa']->kelas->nama}}" readonly  class="form-control mb-0" placeholder="" type="text" name="nama" id="nama"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Bayar</label>
                                            <input id="bayar" type="text" class="form-control {{$errors->first('bayar') ? "is-invalid" : ""}}"  placeholder="0" name="bayar" value="">
                                            <div class="invalid-feedback">
                                                {{ $errors->first('bayar') }}
                                            </div>
                                        </div>

                                        <a href="{{ route('pembayaran.create', ['search' => Request::get('search')]) }}" class="btn btn-secondary">Batal</a>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                    @endisset
                    @endcan
                </div>
            </div>
        @elseif(Request::get('search'))
        <div class="card-box pd-20 height-150-p mx-auto mb-30">
            <div class="align-items-center">
                <h4 class="font-20 weight-500 mb-10 text-capitalize">
                    <div class="weight-600 font-30 color-red">Gagal!!!</div><span style="color: red;">Siswa tidak ditemukan</span>
                </h4>
                <p class="font-18 max-width-600">Pastikan NIS (Nomor Induk Siswa) atau nama siswa benar, silahkan cek siswa di menu siswa jika siswa belum tersedia minta Admin untuk menambahkan siswa.</p>
            </div>
        </div>                
        @else
        <div class="card-box pd-20 height-150-p mx-auto mb-30">
            <div class="align-items-center">
                <h3 class="font-22 weight-600 mb-20 text-capitalize text-blue">
                    Menunggu Anda Untuk Mencari Siswa
                </h3>
                <p class="font-18 max-width-600">Silahkan isi kolom pencarian cari siswa dengan NIS (Nomor Induk Siswa) atau dengan menggunakan nama siswa, Jika data siswa ditemukan maka akan ditampilkan Disini</p>
            </div>
        </div>
        @endif
    </div>
@endsection

@section('script')
    <!-- bootstrap-touchspin js -->
    <script src="{{ asset('deskapp/src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweet-alert.init.js') }}"></script>

    @if (session('gagal'))
        <script>
            swal(
                {
                    title: 'Failed!',
                    text: 'Uang Kurang!',
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif

    @if (session('bayar'))
        <script>
            swal(
                {
                    title: 'Berhasil!',
                    text: 'SPP Telah dibayar!',
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif

    @if (Request::get('status') == "bayar")
        <script>
            swal(
                {
                    title: 'Info!',
                    text: 'Siswa Sudah Bayar!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif

	<script>
        
          
        $("input[name='bayar']").TouchSpin({
			min: -1000000000,
			max: 1000000000,
			stepinterval: 1000,
            step: 50000,
			maxboostedstep: 100,
			prefix: 'Rp'
		});
    </script>

    <script>
        function handle(e){
        var key=e.keyCode || e.which;
            if (key == 13){
                search = $( "#search" ).val();
                window.location.href = 'create?search=' + search  + '&id_spp';
            }
        }
    </script>
@endsection