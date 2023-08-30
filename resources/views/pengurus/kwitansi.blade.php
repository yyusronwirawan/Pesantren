<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" media="dompdf">-->

    <title>Kwitansi - {{$title}}</title>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <table>
                <tr>
                    <td width="700px" style=""><img src="{!! asset('assets/images/almun-logo.png') !!}" alt="logo" style="width: 100%; max-width: 500px" /></td>
                    <td>
                        <p style="margin-bottom:-2px">Nomor Kwitansi : {{$riwayatPembayaran->order_id}}</p>
                        <p style="margin-bottom:-2px">Waktu Bayar : {{$riwayatPembayaran->updated_at}}</p>
                        <p>Waktu Cetak : {{$tanggal}}</p>
                    </td>
                </tr>
            </table>
            <hr />
            <table>
                <tr>
                    <td width="700px" style="">
                        <p>Penerima :</p>
                        <p style="margin-bottom:-10px; margin-top:-4px">Perguruan Islam Pesantren Almuntadhor</p>
                        <p>Jl. Merdeka No55 Desa Babakan, Ciwaringin, Kab.Cirebon</p>
                    </td>
                    <td>
                        <p>Detail Santri (Pembayar) :</p>
                        <p style="margin-bottom:-10px; margin-top:-4px">{{auth()->user()->name}} - {{auth()->user()->username}}</p>
                        <p>Jl. Merdeka No55 Desa Babakan, Ciwaringin, Kab.Cirebon</p>
                    </td>
                </tr>
            </table>


            <table class="table" style="margin-left:50px; margin-top:30px; padding: 0.5rem 0.5rem;">
                <tr>
                    <th width="400px" style="text-align:left">Nama Tagihan</th>
                    <th width="400px" style="text-align:left">Nominal</th>
                    <th width="400px" style="text-align:left">Metode Bayar</th>
                </tr>
                <tr>
                    <td width="400px" style="text-align:left">{{$riwayatPembayaran->tagihan}}</td>
                    <td width="400px" style="text-align:left">{{$riwayatPembayaran->gross_amount}}</td>
                    <td width="400px" style="text-align:left">{{$riwayatPembayaran->payment_type}}</td>
                </tr>
            </table>



            <table style="margin-top:50px;">
                <tr>
                    <td width="750px">
                        <p style="margin-bottom:-10px; color:green;">*Kwitansi ini adalah bukti pembayaran yang SAH </p>
                        <p style="color:green;">dan DIAKUI oleh Perguruan Islam Pesantren Almuntadhor</p>
                    </td>
                    <td>
                        <p style="margin-bottom:-10px; ">Cirebon, 08 Juli 2022</p>
                        <p style="margin-bottom:-10px">Bendahara,</p>
                        <p style="margin-bottom:-10px">TTD</p>
                    </td>
                </tr>

            </table>

            <table style="margin-top:20px;">
                <tr>
                    <td width="1000px" style="background-color:green; color:white; text-align:center; font-size:25px">
                        LUNAS
                    </td>

                </tr>

            </table>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>