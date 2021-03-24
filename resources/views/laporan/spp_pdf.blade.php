<!DOCTYPE html>
<html>
<head>
	<title>Laporan Spp</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Spp</h4>
	</center>
 
	<table class="table stripe nowrap">
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
            @foreach ($spps as $spp)
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
 
</body>
</html>