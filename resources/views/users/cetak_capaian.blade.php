<!DOCTYPE html>
<html>

<head>
    <title>{{$title}}</title>
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
                <h6 class="text-uppercase">{{$title}}</h6>
                <h6>PERGURUAN ISLAM PESANTREN ALMUNTADHOR </h6>
            </center>

            <div class="mb-3">
                <p>Nis/Nama : {{auth()->user()->username}} - {{auth()->user()->name}}</p>
            </div>

            <table class='table table-bordered' style="margin-top:40px;">
                <thead>
                    <tr>
                        <th class="text-center" width="30px">No</th>
                        <th class="text-center" width="80px">Hama Hafalan</th>
                        <th class="text-center" width="40px">Tanggal</th>
                        <th class="text-center" width="40px">Keterangan</th>
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

                    @foreach($data as $santri)
                    <tr>
                        <td>{{ $loop->index +1 }}</td>
                        <td>{{ $santri->hafalan }}</td>
                        <td>{{ $santri->updated_at }}</td>
                        <td class="bg-success text-white">{{ $santri->keterangan }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>