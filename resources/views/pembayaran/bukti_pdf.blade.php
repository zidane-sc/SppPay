<!DOCTYPE html>
<html>
<head>
	<title>Bukti Transaksi</title>
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
		<h5>Bukti Transaksi</h4>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>Nama</th>
				<th>Nominal</th>
				<th>Dibayar</th>
				<th>Kembali</th>
			</tr>
		</thead>
		<tbody>
            <td">{{ $spp->kelas->spps[0]->nama }}</td>
            {{-- <div class="invoice-rate">$20</div> --}}
            <td>{{ $spp->spps[0]->pivot->nominal }}</td>
            <td>{{ $spp->spps[0]->pivot->kembalian }}</td>
            <td>{{ $spp->spps[0]->pivot->bayar }}</td>
        </tbody>
	</table>
 
</body>
</html>