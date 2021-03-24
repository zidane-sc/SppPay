@extends('layouts.app')

@section('title')
    Bukti
@endsection

@section('page')
    Bukti Pembayaran
@endsection

@section('style')
    <style>
        .logo{
            margin: 20px;
            margin-left: 20px;
            width: 95px;
        }

        .headers .title{
            margin-top: 30px;
            letter-spacing: 1px;
            word-spacing: 5px;
            font-size: 28px;
        }

        .address{
            margin-top: 7px;
            margin-bottom: 0px;
            font-size: 15px;
        }

        .info{
            font-size: 15px;
        }

        hr{
            width: 100%;
            color: black;
            border: 1px solid black; 
            margin: 0 15px;
        }

        .bukti{
            margin: 3px auto;
            font-weight: 700;
        }

        .sub-header{
            margin-bottom: -10px;
            line-height: 0em;
        }

        .text{
            margin-left: 120px;
        }

        .mt-10{
            margin-top: 10px;
        }

        .data{
            margin-bottom: 150px;
        }
    </style>
@endsection

@section('breadcumb')
    <li class="breadcrumb-item active" aria-current="page">Bukti</li>
@endsection

@section('right-header')
    <a href="{{ route('pembayaran.cetak', ['id' => $spp->id, 'idspp' => $spp->kelas->spps[0]->id]) }}" class="btn btn-primary">Cetak Bukti</a>
@endsection
@section('content')
    <div class="invoice-wrap mb-30">
        <div class="invoice-box">
            <div class="row mb-3">
                <div class="col-md-2">
                    <div class="logo">
                        <img src="{{ asset('deskapp/src/images/logo-sekolah.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-10 headers">
                    <h4 class="weight-750 title">SMK TARUNA BANGSA</h4>
                    <p class="address">Jl. Lingkar Utara (Kaliabang Tengah) Bekasi Utara Kota Bekasi - 17122</p>
                    <p class="info">Telp. (021)88981166 | Wa. 081319136558 | Web: www.smktarunabangsa.sch.id</p>
                </div>    
                <hr>
                <p class="bukti">BUKTI PEMBAYARAN SISWA</p>
                <hr>
            </div>
            <div class="row pb-30">
                <div class="col-md-6">
                    <p class="font-14 mb-5 sub-header">No Transaksi: <strong class="weight-500">{{ $spp->spps[0]->pivot->no_transaksi }}</strong></p>
                    <p class="font-14 mb-5 sub-header">Nama Petugas: <strong class="weight-500">{{ $user->name }}</strong></p>
                    <p class="font-14 mb-5 sub-header">Tanggal: <strong class="weight-500">{{ date('l, d M Y', strtotime($spp->spps[0]->pivot->waktu_pembayaran)) }}</strong></p>
                    <p class="font-14 mb-5 sub-header">Jam: <strong class="weight-500">{{ date('H:i', strtotime($spp->spps[0]->pivot->waktu_pembayaran)) }}</strong></p>
                </div>
                <div class="col-md-6">
                    <div class="text">
                        <p class="font-14 mb-5 sub-header">Nis: <strong class="weight-500">{{ $spp->nis }}</strong></p>
                        <p class="font-14 mb-5 sub-header">Nama Siswa: <strong class="weight-500">{{ $spp->nama }}</strong></p>
                        <p class="font-14 mb-5 sub-header">Kelas: <strong class="weight-500">{{ $spp->kelas->nama }}</strong></p>
                        <p class="font-14 mb-5 sub-header">Jurusan: <strong class="weight-500">{{ $spp->kelas->jurusan->deskripsi }}</strong></p>
                    </div>
                </div>
                <hr class="mt-10">
            </div>
            <div class="invoice-desc pb-30">
                <div class="invoice-desc-head clearfix">
                    <div class="invoice-sub">Nama</div>
                    {{-- <div class="invoice-rate">Bulan</div> --}}
                    <div class="invoice-hours">Nominal</div>
                    <div class="invoice-subtotal">Kembali</div>
                    <div class="invoice-subtotal">Dibayar</div>
                </div>
                <div class="invoice-desc data">
                    <ul>
                        <li class="clearfix">
                            <div class="invoice-sub">{{ $spp->kelas->spps[0]->nama }}</div>
                            {{-- <div class="invoice-rate">$20</div> --}}
                            <div class="invoice-hours">{{ $spp->spps[0]->pivot->nominal }}</div>
                            <div class="invoice-subtotal"><span class="weight-600">{{ $spp->spps[0]->pivot->kembalian }}</span></div>
                            <div class="invoice-subtotal"><span class="weight-600">{{ $spp->spps[0]->pivot->bayar }}</span></div>
                        </li>
                    </ul>
                </div>
                {{-- <div class="invoice-desc-footer">
                    <div class="invoice-desc-head clearfix">
                        <div class="invoice-sub">Bank Info</div>
                        <div class="invoice-rate">Due By</div>
                        <div class="invoice-subtotal">Total Due</div>
                    </div>
                    <div class="invoice-desc-body">
                        <ul>
                            <li class="clearfix">
                                <div class="invoice-sub">
                                    <p class="font-14 mb-5">Account No: <strong class="weight-600">123 456 789</strong></p>
                                    <p class="font-14 mb-5">Code: <strong class="weight-600">4556</strong></p>
                                </div>
                                <div class="invoice-rate font-20 weight-600">10 Jan 2018</div>
                                <div class="invoice-subtotal"><span class="weight-600 font-24 text-danger">$8000</span></div>
                            </li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('script')
    
@endsection