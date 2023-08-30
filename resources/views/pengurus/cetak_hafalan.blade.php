<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Laporan Hafalan</title>
</head>

<body>
    {{-- Tabel Cetak PDF --}}
    <h3 align="center"><b>Laporan Data Hafalan Santri</br> Pondok Pesantren Al Muntadhor Kabupaten Cirebon</b></h3>
    <table class="static" align="center" rules="all" border="1px" style="width: 95%;">
        <tr>
            <th>No.</th>
            <th>NIS</th>
            <th>Nama Santri</th>
            <th>Tanggal Hafalan</th>
            <th>Hafalan Surat</th>
            <th>Keterangan</th>
        </tr>
        {{-- Perulangan  --}}
        @foreach ($hafalan as $hafal)
        {{-- Pengambilan data dari database  --}}
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $hafal->nis }}</td>
            <td>{{ $hafal->nama }}</td>
            <td>{{ $hafal->tanggal }}</td>
            <td>{{ $hafal->hafalan }}</td>
            <td>{{ $hafal->keterangan }}</td>
        </tr>
        @endforeach
    </table>
</body>

</html>