<!DOCTYPE html>
<html>

<head>
	<title>LAPORAN PEMBAYARAN - {{$title}}</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
	<style type="text/css">
		table tr td,
		table tr th {
			font-size: 9pt;
		}
	</style>
	<div class="card">
		<div class="card-body">
			<center>
				<div class="row">
					<div class="col">
						<img src="{!! asset('assets/images/almun-logo.png') !!}" alt="logo" style="width: 100%; max-width: 400px" />
					</div>
					<div class="col" style="margin-top:30px">
						<p style="margin-bottom:-2px">Waktu Cetak : {{$tanggal}}</p>
					</div>
				</div>
				<hr />
				<h6 class="text-uppercase">LAPORAN PEMBAYARAN {{$title}}</h6>
				<h6>PERGURUAN ISLAM PESANTREN ALMUNTADHOR </h6>
			</center>


			<table class='table table-bordered' style="margin-top:40px;">
				<thead>
					<tr>
						<th width="30px">No</th>
						<th width="70px">Nis</th>
						<th width="70px">Tagihan</th>
						<th width="40px">Nominal</th>
						<th width="40px">Metode</th>
						<th width="50px">Keterangan</th>
					</tr>
				</thead>
				<tbody>
					@if($data->isEmpty())
					<tr>
						<td colspan="6" class="text-center">
							<h6>Tidak ada data !</h6>
						</td>
					</tr>

					@endif

					@foreach($data as $d)
					<tr>

						<td>{{$loop->index + 1}}</td>
						<td>{{$d->nis}}</td>
						<td>{{$d->tagihan}}</td>
						<td>Rp. {{number_format($d->gross_amount)}}</td>
						@if ($d->payment_type == 'echannel')
						<td class="text-uppercase">Bank Mandiri</td>
						@endif
						@if ($d->payment_type == 'cstore')
						<td class="text-uppercase">Indomaret/Alfamart</td>
						@endif
						@if ($d->payment_type == 'bank_transfer')
						<td class="text-uppercase">{{ $d->bank }}</td>
						@endif
						<td><span class="badge rounded-pill bg-success text-white">Lunas</span> | {{$d->updated_at}}</td>
					</tr>

					@endforeach
				</tbody>
			</table>
		</div>
	</div>

</body>

</html>