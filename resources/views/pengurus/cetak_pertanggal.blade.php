<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Laporan Keuangan</title>
</head>

<body>
    {{-- Tabel Cetak PDF --}}
    <h3 align="center"><b>Laporan Data Pembayaran</br> Pondok Pesantren Al Muntadhor Kabupaten Cirebon</b></h3>
    <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
        <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>Nama Santri</th>
            <th>Tanggal Pembayaran</th>
            <th>Nominal Pembayaran</th>
            <th>Bukti Pembayaran</th>
            <th>Keterangan</th>
        </tr>
        {{-- Perulangan  --}}
        @foreach ($colleges as $college)
        {{-- Pengambilan data dari database  --}}
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $college->nis }}</td>
            <td>{{ $college->nama }}</td>
            <td>{{ $college->tanggal }}</td>
            <td>{{ $college->nominal }}</td>
            <td>{{ $college->bukti }}</td>
            <td>{{ $college->keterangan }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>