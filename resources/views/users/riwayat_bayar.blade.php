@extends('layouts.main')
<!-- container -->
@section('container')
<!-- Navbar -->
@include('partials.navbar')
<!-- Sidebar -->
@include('partials.sidebar')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-success text-white me-2">
          <a href="{{ URL::previous() }}" style="color:white"><i class="fas fa-arrow-circle-left"></i></a>
        </span> Riwayat Pembayaran
      </h3>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col mb-3">
            <!-- Button trigger modal -->
            <a href="{{route('riwayat-pembayaran.cetak_all_user')}}" class="btn btn-sm btn-primary mb-2"> <i class="fas fa-download"></i> Download Semua Riwayat Pembayaran (pdf)</a>
            <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#DownloadData">
              <i class="fas fa-download"></i> Download Riwayat Perbulan
            </button>
            <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#DownloadDataPelajaran">
              <i class="fas fa-download"></i> Download Rekap Pertahun
            </button>
          </div>
        </div>

        <small>Lihat Riwayat berdasarkan :</small>
        <form action="{{route('riwayat-pembayaran.cari_data_riwayat')}}" method="POST" enctype="multipart/form-data">
          @method('POST')
          @csrf
          <div class="input-group mb-3">
            <div class="form-outline" style="margin-right: 5px; margin-top: 5px">

              <select name="bulan" class="form-select" aria-label="Default select example">
                <option selected>Pilih bulan</option>
                @php
                $bulan=array("januari","februari","maret","april","mei","juni","juli","agustus","september","oktober","november","desember");
                $jlh_bln=count($bulan);
                for($c=0; $c<$jlh_bln; $c+=1){ echo"<option value=$bulan[$c]> $bulan[$c] </option>";
                  }
                  @endphp

              </select>
            </div>
            <div class="form-outline" style="margin-top: 5px">
              <select name="tahun" id="" class="form-select" required>
                <option notselected>Pilih tahun..</option>
                @for ($i=date('Y'); $i>=date('Y')-32; $i-=1)
                <option value='{{$i}}'> {{$i}} </option>
                @endfor
              </select>

            </div>
            <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 5px">Tampilkan</button>
          </div>
        </form>

        <div class="list-group d-block d-sm-none">
          @if($riwayatPembayaran->isEmpty())
          <div class="alert alert-warning" role="alert">
            Belum ada data riwayat pembayaran
          </div>
          @endif
          @foreach($riwayatPembayaran as $santri)
          <div class="list-group-item list-group-item-action">
            {{ $santri->tagihan }}
            <p>{{ $santri->updated_at }}</p>
            <div class="d-flex justify-content-between align-items-center">
              <p style="margin-top:-20px" class="text-uppercase">
                @if ($santri->payment_type == 'echannel')
                {{$santri->gross_amount}} | Bank Mandiri
                @endif
                @if ($santri->payment_type == 'cstore')
                {{$santri->gross_amount}} | Indomart/Alfamart
                @endif
                @if ($santri->payment_type == 'bank_transfer')
                {{$santri->gross_amount}} | {{$santri->bank}}
                @endif
                <span class="text-success">Lunas</span></td>
              </p>
              <a href="/cetak-kwitansi/{{ $santri->id }}" class="btn btn-sm btn-success"><i class="fas fa-print"></i> Cetak</a></td>
            </div>
          </div>
          @endforeach

          @foreach($riwayatPembayaran1 as $santri1)
          <div class="list-group-item list-group-item-action">
            {{ $santri1->tagihan }}
            <p>{{ $santri1->updated_at }}</p>
            <div class="d-flex justify-content-between align-items-center">
              <p style="margin-top:-20px" class="text-uppercase">
                @if ($santri1->payment_type == 'echannel')
                {{$santri1->gross_amount}} | Bank Mandiri
                @endif
                @if ($santri1->payment_type == 'cstore')
                {{$santri1->gross_amount}} | Indomart/Alfamart
                @endif
                @if ($santri1->payment_type == 'bank_transfer')
                {{$santri1->gross_amount}} | {{$santri1->bank}}
                @endif
                <span class="text-success">Lunas</span></td>
              </p>
              <a href="/cetak-kwitansi/{{ $santri1->id }}" class="btn btn-sm btn-success"><i class="fas fa-print"></i> Cetak</a></td>
            </div>
          </div>
          @endforeach

        </div>

        <div class="table-responsive d-none d-sm-block">
          <table class="table table-hover">
            <thead>
              <th scope="col">NO</th>
              <th scope="col">TAGIHAN</th>
              <th scope="col">NOMINAL</th>
              <th scope="col">METHODE</th>
              <th scope="col">WAKTU BAYAR</th>
              <th scope="col">KET</th>
              <th scope="col">KWITANSI</th>
            </thead>
            <tbody>
              @foreach($riwayatPembayaran as $santri)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $santri->tagihan }}</td>
                <td>RP. {{ number_format($santri->gross_amount) }}</td>
                @if ($santri->payment_type == 'echannel')
                <td class="text-uppercase">Bank Mandiri</td>
                @endif
                @if ($santri->payment_type == 'cstore')
                <td class="text-uppercase">Indomaret/Alfamart</td>
                @endif
                @if ($santri->payment_type == 'bank_transfer')
                <td class="text-uppercase">{{ $santri->bank }}</td>
                @endif
                <td>{{ $santri->updated_at }}</td>
                <td><span class="badge badge-success">Lunas</span></td>
                <td><a href="/cetak-kwitansi/{{ $santri->id }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download</a></td>
              </tr>
              @endforeach
              @foreach($riwayatPembayaran1 as $santri1)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $santri1->tagihan }}</td>
                <td>RP. {{ number_format($santri1->gross_amount) }}</td>
                @if ($santri1->payment_type == 'echannel')
                <td class="text-uppercase">Bank Mandiri</td>
                @endif
                @if ($santri1->payment_type == 'cstore')
                <td class="text-uppercase">Indomaret/Alfamart</td>
                @endif
                @if ($santri1->payment_type == 'bank_transfer')
                <td class="text-uppercase">{{ $santri1->bank }}</td>
                @endif
                <td>{{ $santri1->updated_at }}</td>
                <td><span class="badge badge-success">Lunas</span></td>
                <td><a href="/cetak-kwitansi/{{ $santri1->id }}" class="btn btn-sm btn-success"><i class="fas fa-download"></i> Download</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- selesai content -->
<!-- Footer -->
@include('partials.footer')


<!-- Modal Download Perbulan-->
<div class="modal fade" id="DownloadData" tabindex="-1" aria-labelledby="DownloadDataLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="DownloadDataLabel">Riwayat Perbulan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{-- Form tambah hafalan  --}}
        <form action="{{route('riwayat-pembayaran.cetak_perbulan_user')}}" method="GET">
          {{-- CSRF merupakan keamanan yang disediakan laravel  --}}
          <div class="mb-3">
            <label for="" class="form-label">Bulan</label>
            <select name="bulan" class="form-select" aria-label="Default select example">
              <option selected>Pilih bulan</option>
              @php
              $bulan=array("januari","februari","maret","april","mei","juni","juli","agustus","september","oktober","november","desember");
              $jlh_bln=count($bulan);
              for($c=0; $c<$jlh_bln; $c+=1){ echo"<option value=$bulan[$c]> $bulan[$c] </option>";
                }
                @endphp

            </select>
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Tahun</label>
            <select name="tahun" id="" class="form-select" required>
              <option notselected>Pilih tahun..</option>
              @for ($i=date('Y'); $i>=date('Y')-32; $i-=1)
              <option value='{{$i}}'> {{$i}} </option>
              @endfor
            </select>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Download</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Download Pertahun-->
<div class="modal fade" id="DownloadDataPelajaran" tabindex="-1" aria-labelledby="DownloadDataPelajaranLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="DownloadDataPelajaranLabel">Riwayat Pertahun</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{-- Form tambah hafalan  --}}
        <form action="{{route('riwayat-pembayaran.cetak_pertahun_user')}}" method="GET">
          {{-- CSRF merupakan keamanan yang disediakan laravel  --}}

          <div class="mb-3">
            <label for="" class="form-label">Tahun</label>
            <select name="tahun" id="" class="form-select" required>
              <option notselected>Pilih tahun..</option>
              @for ($i=date('Y'); $i>=date('Y')-32; $i-=1)
              <option value='{{$i}}'> {{$i}} </option>
              @endfor
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Download</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>