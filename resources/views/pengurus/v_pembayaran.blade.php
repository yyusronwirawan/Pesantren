@extends('pengurus.main')
@section('pengurus')
@include('pengurus.navbar')
@include('pengurus.sidebar')

<main id="main" class="main">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Laporan Pembayaran</h1>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade" id="DownloadTagihan" tabindex="-1" aria-labelledby="DownloadTagihanLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="DownloadTagihanLabel">Download Laporan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <form action="{{route('data-pembayaran.laporan-perbulan')}}" method="GET" enctype="multipart/form-data">
              <label for="" class="form-label">1. Laporan Perbulan</label>
              <select name="bulan" class="form-select" aria-label="Default select example" required>
                <option selected>Pilih bulan</option>
                @php
                $bulan=array("januari","februari","maret","april","mei","juni","juli","agustus","september","oktober","november","desember");
                $jlh_bln=count($bulan);
                for($c=0; $c<$jlh_bln; $c+=1){ echo"<option value=$bulan[$c]> $bulan[$c] </option>";
                  }
                  @endphp
              </select>
              <input type="text" name="tahun" id="" class="form-control" placeholder="2022" style="margin-top: 10px" required>
              <div class="text-center">
                <button type="submit" name="submit" class="btn btn-sm btn-primary mt-3">Download Laporan Perbulan</button>
              </div>
          </div>
          </form>
          <hr />
          <div class="mb-3">
            <label for="" class="form-label">2. Laporan Semua Data</label>
            <div class="text-center">
              <a href="{{route('data-pembayaran.laporan-all')}}" class="btn btn-sm btn-primary mt-3">Download Laporan Semua Data</a>
            </div>
          </div>
          <hr />
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      @if(session('success'))
      <div class="alert alert-success">
        <b>Berhasil!</b> {{session('success')}}
      </div>
      @elseif(session('error'))
      <div class="alert alert-danger">
        <b>Maaf!</b> {{session('error')}}
      </div>
      @endif
      <div class="card">
        <div class="card-body">
          <div class="row" style="margin-left: 10px; margin-top:20px">
            <div class="col mb-3">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#DownloadTagihan">
                <i class="fas fa-download"></i> Download Laporan Pdf
              </button>
            </div>
          </div>
          <div class="row mb-3">
            <label for="cari" class="col-form-label">Cari Data:</label>
            <form class="d-flex" method="POST" action="{{route('search')}}">
              @csrf
              <div class="col-sm-5">
                <input class="form-control" name="keyword" type="search" placeholder="Cari berdasarkan nis" aria-label="Search">
              </div>
              <div class="col">
                <span class="form-text">
                  <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                </span>
              </div>
            </form>
          </div>
          <div class="table-responsive">
            <table class="table table-striped table-hover" style="vertical-align: middle">
              <thead>
                <th scope="col">NO</th>
                <th scope="col">NIS</th>
                <th scope="col">NAMA SANTRI</th>
                <th scope="col">TAGIHAN</th>
                <th scope="col">NOMINAL</th>
                <th scope="col">METODE</th>
                <th scope="col">WAKTU BAYAR</th>
                <th scope="col">KET</th>
                {{-- <th scope="col">KWITANSI</th> --}}
              </thead>
              @foreach($colleges as $college)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $college->nis }}</td>
                @foreach ($user as $u)
                @if ($u->username == $college->nis)
                <td>{{ $u->name }}</td>
                @endif
                @endforeach
                <td>{{ $college->tagihan }}</td>
                <td>RP. {{ number_format($college->gross_amount) }}</td>

                @if ($college->payment_type == 'echannel')
                <td class="text-uppercase">Bank Mandiri</td>
                @endif
                @if ($college->payment_type == 'cstore')
                <td class="text-uppercase">Indomaret/Alfamart</td>
                @endif
                @if ($college->payment_type == 'bank_transfer')
                <td class="text-uppercase">{{ $college->bank }}</td>
                @endif

                <td>{{ $college->updated_at }}</td>
                <td><span class="badge rounded-pill bg-success">Lunas</span></td>
                {{-- <td><a  href="/cetak-kwitansi/{{ $college->order_id }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download</a></td> --}}
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@include('pengurus.footer')
@endsection