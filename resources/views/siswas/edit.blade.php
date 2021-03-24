@extends('layouts.app')

@section('title')
    Edit Siswa
@endsection

@section('page')
    Edit Siswa
@endsection

@section('style')
    <style>
        label{
            margin-top: 8px;
        }

        .btn{
            margin-top: 20px;
            width: 100px;
        }
    </style>
@endsection

@section('breadcumb')
    <li class="breadcrumb-item active" aria-current="page">Edit Siswa</li>
@endsection

@section('content')
        <div class="pd-20 card-box col-md-9 mx-auto mb-30">
            <div class="clearfix">
                <div class="pull-left">
                    <h4 class="text-blue h4">Form Edit Siswa</h4>
                    <p class="mb-30">Ubah data siswa</p>
                </div>
            </div>
            <form enctype="multipart/form-data" action="{{route('siswa.update', $siswa->id)}}" method="POST">
                @csrf              
                @method('put')

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input value="{{ old('nama') ?? $siswa->nama  }}"  class="form-control {{ $errors->first('nama') ? 'is-invalid' : '' }}" placeholder="Nama Lengkap" type="text" name="nama" id="nama" />
                    <div class="invalid-feedback">
                        {{ $errors->first('nama') }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="nis">Nis</label>
                    <input value="{{ old('nis') ?? $siswa->nis }}" class="form-control {{ $errors->first('nis') ? 'is-invalid' : '' }}" placeholder="Nis" type="text" name="nis" id="nis" readonly/>
                    <div class="invalid-feedback">
                        {{ $errors->first('nis') }}
                    </div>
                </div>

                <div class="form-group">
                    <label>Kelas</label>
                    <select class="selectpicker form-control {{ $errors->first('kelas_id') ? 'is-invalid' : '' }}" name="kelas_id" id="kelas_id"  data-size="5">
                            <option disabled selected>Pilih Kelas</option>
                        @foreach ($kelas as $item)
                            <option data-subtext="{{ $item->wali_kelas }}" value="{{ $item->id }}" {{ (( old('kelas_id') ?? $siswa->kelas_id ) == $item->id) ? 'selected' : '' }}>{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('kelas_id') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <label class="weight-600" style="display: block;">Jenis Kelamin</label>
                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                <input type="radio" id="customRadio1" name="jenis_kelamin" class="custom-control-input" {{ (( old('jenis_kelamin') ?? $siswa->jenis_kelamin ) == 'laki-laki') ? 'checked' : '' }} value="laki-laki">
                                <label class="custom-control-label" for="customRadio1">laki-laki</label>
                            </div>
                            <div class="custom-control custom-radio mr-2" style="display: inline;">
                                <input type="radio" id="customRadio2" name="jenis_kelamin" class="custom-control-input" {{ (( old('jenis_kelamin') ?? $siswa->jenis_kelamin ) == 'perempuan') ? 'checked' : '' }}  value="perempuan">
                                <label class="custom-control-label" for="customRadio2">perempuan</label>
                            </div>
                            <div class="small text-danger">
                                {{$errors->first('jenis_kelamin')}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="no_telp">No Telepon</label>
                    <input value="{{old('no_telp') ?? $siswa->no_telp }}" type="text" name="no_telp" class="form-control {{$errors->first('no_telp') ? "is-invalid" : ""}} ">
                    <div class="invalid-feedback">
                        {{$errors->first('no_telp')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control {{$errors->first('alamat') ? "is-invalid" : ""}}">{{old('alamat') ?? $siswa->alamat }}</textarea>
                    <div class="invalid-feedback">
                        {{$errors->first('alamat')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="avatar">Avatar image</label>
                    <div class="custom-file">
                        <input type="file" class="form-control {{$errors->first('avatar') ? "is-invalid" : ""}}" id="avatar" name="avatar">
                        {{-- <label class="custom-file-label">Choose file</label> --}}
                    </div>
                    <small class="form-text text-muted pt-2">
                        Kosongkan jika tidak ingin menambahkan gambar    
                    </small>
                    <div class="invalid-feedback">
                        {{$errors->first('avatar')}}
                    </div>
                </div>
           

                <div class="form-group">
                    <label for="tempat_lahir">Tempat Lahir</label>
                    <input value="{{old('tempat_lahir') ?? $siswa->tempat_lahir }}" class="form-control {{$errors->first('tempat_lahir') ? "is-invalid" : ""}}" placeholder="Tempat Lahir"type="text" name="tempat_lahir" id="tempat_lahir"/>
                    <div class="invalid-feedback">
                        {{$errors->first('tempat_lahir')}}
                    </div>
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input value="{{ old('tanggal_lahir') ?? $siswa->tanggal_lahir }}"  class="form-control date-picker {{$errors->first('tanggal_lahir') ? "is-invalid" : ""}}" placeholder="Pilih Tanggal Lahir" type="text" name="tanggal_lahir" id="tanggal_lahir">
                    <div class="invalid-feedback">
                        {{$errors->first('tanggal_lahir')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama_ayah">Nama Ayah</label>
                    <input value="{{old('nama_ayah') ?? $siswa->nama_ayah }}" class="form-control {{$errors->first('nama_ayah') ? "is-invalid" : ""}}" placeholder="Tempat Lahir"type="text" name="nama_ayah" id="nama_ayah"/>
                    <div class="invalid-feedback">
                        {{$errors->first('nama_ayah')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                    <input value="{{old('pekerjaan_ayah') ?? $siswa->pekerjaan_ayah }}" class="form-control {{$errors->first('pekerjaan_ayah') ? "is-invalid" : ""}}" placeholder="Tempat Lahir"type="text" name="pekerjaan_ayah" id="pekerjaan_ayah"/>
                    <div class="invalid-feedback">
                        {{$errors->first('pekerjaan_ayah')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="nama_ibu">Nama Ibu</label>
                    <input value="{{old('nama_ibu') ?? $siswa->nama_ibu }}" class="form-control {{$errors->first('nama_ibu') ? "is-invalid" : ""}}" placeholder="Tempat Lahir"type="text" name="nama_ibu" id="nama_ibu"/>
                    <div class="invalid-feedback">
                        {{$errors->first('nama_ibu')}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="pekerjaan_ibu">Pekerjaan Ibu</label>
                    <input value="{{old('pekerjaan_ibu') ?? $siswa->pekerjaan_ibu  }}" class="form-control {{$errors->first('pekerjaan_ibu') ? "is-invalid" : ""}}" placeholder="Tempat Lahir"type="text" name="pekerjaan_ibu" id="pekerjaan_ibu"/>
                    <div class="invalid-feedback">
                        {{$errors->first('pekerjaan_ibu')}}
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Back</a>
            </form>
            
        <div class="collapse-box collapse show" id="horizontal-basic-form1" style="">
    </div>
</div>
@endsection

@section('script')
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('deskapp/src/plugins/sweetalert2/sweet-alert.init.js') }}"></script>

    @if (session('status'))
        <script>
            swal(
                {
                    title: 'Success!',
                    text: 'User Successfully added!',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonClass: 'btn btn-success',
                }
            )
        </script>
    @endif

@endsection