@extends('pengurus.main')
@section('pengurus')
@include('pengurus.navbar')
@include('pengurus.sidebar')

<main id="main" class="main">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Tagihan</h1>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Tagihan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="alert alert-info" role="alert">
            <p>PERHATIAN !</p>
            <ul>
              <li>From ini hanya untuk menambahkan tagihan selain Tagihan Syariyyah/Bulanan</li>
              <li>Tagihan yang ditambahkan disini, akan ditagihkan keseluruh santri </li>
            </ul>
          </div>
          <form action="{{route('data-tagihan.store')}}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="mb-3">
              <label for="" class="form-label">Tagihan Pembayaran</label>
              <input type="text" name="tagihan" id="" class="form-control" placeholder="contoh : Daftar Ulang 2022">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Nominal Pembayaran</label>
              <p><small class="text-info">*Tidak perlu menggunakan tanda titik(.)</small></p>
              <input type="text" name="nominal" class="form-control" placeholder="contoh : 200000">
              <!-- <input required name="nominal" type="text" value="Rp. 350.000-," class="form-control" readonly> -->
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Ditagihkan pada Bulan</label>
              <select name="bulan" class="form-select" aria-label="Default select example">
                <option selected>Pilih bulan</option>
                @php
                $bulan=array("januari","februari","maret","april","mei","juni","juli","agustus","september","oktober","november","desember");
                $jlh_bln=count($bulan);
                for($c=0; $c<$jlh_bln; $c+=1){ echo"<option value=$bulan[$c]> $bulan[$c] </option>";
                  }
                  @endphp

              </select>
              <!-- <input required name="nominal" type="text" value="Rp. 350.000-," class="form-control" readonly> -->
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Ditagihkan pada Tahun</label>
              <input type="text" name="tahun" id="" class="form-control" placeholder="2022">
              <input type="text" name="keterangan" id="" class="form-control" value="Belum Lunas" hidden>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="DownloadTagihan" tabindex="-1" aria-labelledby="DownloadTagihanLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="DownloadTagihanLabel">Download Laporan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <form action="{{route('data-tagihan.cetak-perbulan')}}" method="POST" enctype="multipart/form-data">
              @csrf
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
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-plus"></i> Tambah Tagihan
              </button>
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
              <tr>
                <th>No.</th>
                <th>NIS</th>
                <th>Nama Santri</th>
                <th>Tagihan</th>
                <th>Nominal</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
              @foreach($dataTagihan as $tagihan)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $tagihan->nis }}</td>
                @foreach ($user as $u)
                @if ($u->username == $tagihan->nis)
                <td>{{ $u->name }}</td>
                @endif
                @endforeach
                <td>{{ $tagihan->tagihan }}</td>
                <td>{{ $tagihan->nominal }}</td>
                <td> <span class="badge rounded-pill bg-danger">{{ $tagihan->keterangan }}</span></td>
                <form action="{{route('data-tagihan.destroy', $tagihan->id)}}" method="POST">
                  @method('delete')
                  @csrf
                  <td><button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i> Bayar Cash</button></td>
              </tr>
              </form>
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