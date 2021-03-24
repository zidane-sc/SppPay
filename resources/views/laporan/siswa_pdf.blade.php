<!DOCTYPE html>
<html>
<head>
	<title>Laporan Siswa</title>
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
		<h5>Laporan Siswa</h4>
	</center>
 
	<table class="table stripe nowrap">
        <thead>
            <tr>
                <th class="table-plus">No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswas as $siswa)
                <tr>
                    <td class="table-plus">{{ $loop->iteration }}</td>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama }}</td>
                    <td>{{ $siswa->kelas->nama }}</td>
                    <td>{{ $siswa->no_telp }}</td>
                    <td>{{ Str::limit($siswa->alamat, 30, '...') }}</td>
                    <td>{{ $siswa->jenis_kelamin }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
 
</body>
</html>