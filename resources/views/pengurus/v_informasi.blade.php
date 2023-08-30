@extends('pengurus.main')
@section('pengurus')
@include('pengurus.navbar')
@include('pengurus.sidebar')
<main id="main" class="main">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Informasi Pribadi</h1>
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
          <form action="{{route('data-informasi.store')}}" method="POST" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="mb-3">
              <label for="" class="form-label">Penerima</label>
              <input required name="penerima" type="text" class="form-control" placeholder="Masukkan penerima informasi">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Judul Informasi</label>
              <input required name="judul" type="text" class="form-control" placeholder="Masukkan judul informasi">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Gambar</label>
              <input required name="gambar" id="gambar" type="file" class="form-control">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Deskripsi</label>
              <textarea required name="deskripsi" type="text" class="form-control" placeholder="Masukkan deskripsi informasi"></textarea>
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
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row" style="margin-left: 10px; margin-top:20px">
            <div class="col mb-3">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-plus"></i>Tambah Data
              </button>
              <a href="santri" class="btn btn-primary">
                <i class="fas fa-eye"></i> Data Santri
              </a>
            </div>
          </div>
          <div class="row mb-3">
            <label for="cari" class="col-form-label">Cari Data:</label>
            <form class="d-flex" method="POST" action="{{route('search')}}">
              @csrf
              <div class="col-sm-5">
                <input class="form-control" name="keyword" type="search" placeholder="Cari berdasarkan nama" aria-label="Search">
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
                <th>Penerima</th>
                <th>Judul Informasi</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
              </tr>
              @foreach($uploads as $upload)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $upload->penerima }}</td>
                <td>{{ $upload->judul }}</td>
                <td>{{ $upload->gambar }}</td>
                <td>{{ $upload->deskripsi }}</td>
                <td>
                  <form action="{{route('data-informasi.destroy', $upload->id)}}" method="POST">
                    <a href="{{ asset('/informasi/'. $upload->gambar) }}" class="btn btn-warning fas fa-eye"></a>
                    <a href="{{route('data-informasi.edit', $upload->id)}}" class="btn btn-primary fas fa-edit"></a>
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger fas fa-trash-alt"></button>
                  </form>
                </td>
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