@extends('layouts.app')

@section('title')
    Show
@endsection

@section('page')
    Detail Siswa
@endsection

@section('style')
    
@endsection

@section('breadcumb')
    <li class="breadcrumb-item active" aria-current="page">Detail Siswa</li>
@endsection

@section('right-header')
    <a href="{{ route('siswa.index') }}" class="btn btn-lg btn-secondary">Back to table siswa</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-4 mx-auto  col-lg-4 col-md-4 col-sm-12 mb-30">
            <div class="pd-20 card-box height-100-p">
                <div class="profile-photo">
                    @if($siswa->avatar)
                        <img src="{{asset('storage/'. $siswa->avatar)}}" class="avatar-photo mx-auto"  width="160px"/>
                    @else
                        <img src="{{ asset('deskapp/src/images/no-image.png') }}" class="avatar-photo mx-auto"  width="160px">
                    @endif
                </div>
                <h5 class="text-center h5 mb-5">{{ $siswa->nis }}</h5>
                {{-- <p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p> --}}
                <div class="profile-info">
                    <h5 class="mb-20 h5 text-blue">Detail Information</h5>
                    <ul>
                        <li>
                            <span>Nama:</span>
                            {{ $siswa->nama }}
                        </li>
                        <li>
                            <span>No Telepon:</span>
                            {{ $siswa->no_telp }}
                        </li>
                        <li>
                            <span>Kelas:</span>
                            {{ $siswa->kelas->nama }}
                        </li>
                        <li>
                            <span>Jurusan:</span>
                            {{ $siswa->kelas->jurusan->deskripsi }}
                        </li>
                        <li>
                            <span>Alamat:</span>
                            {{ $siswa->alamat }}
                        </li>
                        <li>
                            <span>Jenis Kelamin:</span>
                            {{ $siswa->jenis_kelamin }}
                        </li>
                        <li>
                            <span>Tempat Lahir:</span>
                            {{ $siswa->tempat_lahir }}
                        </li>
                        <li>
                            <span>Tanggal Lahir:</span>
                            {{ $siswa->tanggal_lahir }}
                        </li>
                        <li>
                            <span>Nama Ayah:</span>
                            {{ $siswa->nama_ayah }}
                        </li>
                        <li>
                            <span>Pekerjaan Ayah:</span>
                            {{ $siswa->pekerjaan_ayah }}
                        </li>
                        <li>
                            <span>Nama Ibu:</span>
                            {{ $siswa->nama_ibu }}
                        </li>
                        <li>
                            <span>Pekerjaan Ibu:</span>
                            {{ $siswa->pekerjaan_ibu }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection