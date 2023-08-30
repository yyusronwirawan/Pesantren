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
                </div>
                <hr />
                <h6 class="text-uppercase">{{$title}}</h6>
                <h6>PERGURUAN ISLAM PESANTREN ALMUNTADHOR </h6>
            </center>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col" style="margin-top:30px">
                            <p style="margin-bottom:-2px">Nama : {{auth()->user()->name}}</p>
                            <p style="margin-bottom:-2px">Nama : {{auth()->user()->kelas}}</p>
                            <p style="margin-bottom:-2px">Nama : {{auth()->user()->tahun_ajar}}</p>
                            <p style="margin-bottom:-2px">Waktu Cetak : {{$tanggal}}</p>
                        </div>
                    </div>



                    <table class='table table-bordered' style="margin-top:40px;">
                        <thead>
                            <tr>
                                <th class="text-center" width="30px">No</th>
                                <th class="text-center" width="80px">Mata Pelajaran</th>
                                <th class="text-center" width="50px">Kelas</th>
                                <th class="text-center" width="40px">Tahun Ajaran</th>
                                <th class="text-center" width="40px">Kehadiran</th>
                                <th class="text-center" width="40px">Tugas</th>
                                <th class="text-center" width="40px">UTS</th>
                                <th class="text-center" width="40px">UAS</th>
                                <th class="text-center" width="40px">Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($tampilUser->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center">
                                    <h6>Tidak ada data !</h6>
                                </td>
                            </tr>

                            @endif

                            @foreach($tampilUser as $show)
                            <tr>
                                <td class="text-center">{{ $loop->index + 1 }}</td>
                                <td>{{ $show->pelajaran }}</td>
                                <td>{{ $show->kelas }}</td>
                                <td>{{ $show->tahun_ajar }}</td>
                                <td class="text-center">{{ $show->kehadiran }}</td>
                                <td class="text-center">{{ $show->tugas }}</td>
                                <td class="text-center">{{ $show->uts }}</td>
                                <td class="text-center">{{ $show->uas }}</td>
                                <td class="text-center">
                                    @php
                                    $nilai_akhir = ($show->kehadiran + $show->tugas + $show->uts + $show->uas) / 4
                                    @endphp
                                    {{$nilai_akhir}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

</body>

</html>