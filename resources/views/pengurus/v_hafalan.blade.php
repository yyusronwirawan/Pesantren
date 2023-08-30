@extends('pengurus.main')
@section('pengurus')
@include('pengurus.navbar')
@include('pengurus.sidebar')

<main id="main" class="main">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Hafalan</h1>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('data-hafalan.store')}}" method="POST">
            @method('POST')
            @csrf
            <div class="mb-3">
              <label for="" class="form-label">NIS Santri</label>
              <input required name="nis" type="text" class="form-control" placeholder="Masukkan NIS Santri">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Capaian Hafalan</label>
              <select name="hafalan" class="form-select">
                <option notselected>Pilih hafalan</option>
                @foreach ($prestasi as $prestasi)
                <option value="{{$prestasi->nama_prestasi}}">{{$prestasi->nama_prestasi}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Keterangan</label>
              <select name="keterangan" class="form-select" aria-label="Default select example">
                <option hidden selected>Pilih keterangan</option>
                <option value="Lulus">Lancar</option>
                <option value="Mengulang">Belum Lancar</option>
              </select>
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
  <section class="content">
    <div class="card">
      <div class="card-body">
        <div class="row" style="margin-left: 10px; margin-top:20px">
          <div class="col mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
              <i class="fas fa-plus"></i> Tambah Data
            </button>
            <a href="{{ route('data-hafalan.cetak-form') }}" class="btn btn-primary">
              <i class="fas fa-print"></i> Cetak Data
            </a>
            <a href="santri" class="btn btn-primary">
              <i class="fas fa-eye"></i> Data Santri
            </a>
          </div>
        </div>
        <div class="row align-items-center mb-3">
          <div class="col-auto">
            <label for="cari" class="col-form-label">Cari Data:</label>
          </div>
          <form class="d-flex" method="POST" action="{{route('cari')}}">
            @csrf
            <div class="col-auto">
              <input class="form-control" name="keyword" type="search" placeholder="Cari berdasarkan nama" aria-label="Search">
            </div>
            <div class="col-auto">
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
              <th>Tanggal Hafalan</th>
              <th>Hafalan Surat</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
            @foreach($hafalan as $hafal)
            <tr>
              <td>{{ $loop->index + 1 }}</td>
              <td>{{ $hafal->nis }}</td>
              <td>{{ $hafal->nama }}</td>
              <td>{{ $hafal->tanggal }}</td>
              <td>{{ $hafal->hafalan }}</td>
              <td>{{ $hafal->keterangan }}</td>
              <td>
                <form action="{{route('data-hafalan.destroy', $hafal->id)}}" method="POST">
                  <a href="{{route('data-hafalan.edit', $hafal->id)}}" class="btn btn-primary">Ubah</a>
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
  </section>
</main>
@include('pengurus.footer')
@endsection