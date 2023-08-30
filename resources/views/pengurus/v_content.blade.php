@extends('pengurus.main')
<!-- container -->
@section('pengurus')
<!-- Navbar -->
@include('pengurus.navbar')
<!-- Sidebar -->
@include('pengurus.sidebar')
<!-- Content Wrapper. Contains page content -->
<main id="main" class="main">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Brankas Content</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          {{-- Form tambah pembayaran  --}}
          <form action="{{route('data-content.store')}}" method="POST" enctype="multipart/form-data">
            {{-- CSRF merupakan keamanan yang disediakan laravel  --}}
            @method('POST')
            @csrf
            <!-- <div class="mb-3">
                <label for="" class="form-label">Content_id</label>
                <input required name="content_id" type="text" class="form-control" placeholder="Masukkan NIS Santri">
              </div> -->
            <div class="mb-3">
              <label for="" class="form-label">Content_id</label>
              <select name="content_id" class="form-select" aria-label="Default select example">
                <option selected>Pilih content_id</option>
                <option value="Ct-D">Ct-D</option>
                <option value="Ct-I">Ct-I</option>
                <option value="Ct-G">Ct-G</option>
                <option value="Ct-P">Ct-P</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Judul Content</label>
              <input required name="judul" type="text" class="form-control" placeholder="Masukkan Nama Lengkap Santri">
            </div>
            <!-- <div class="mb-3">
                <label for="" class="form-label">Kategori</label>
                <input required name="kategori" type="text" class="form-control" placeholder="Masukkan tanggal pembayaran">
              </div> -->
            <div class="mb-3">
              <label for="" class="form-label">Kategori Content</label>
              <select name="kategori" class="form-select" aria-label="Default select example">
                <option selected>Pilih kategori</option>
                <option value="Dashboard">Dashboard</option>
                <option value="Gallery">Gallery</option>
                <option value="Informasi">Informasi</option>
                <option value="Pengumuman">Pengumuman</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Gambar</label>
              <input required name="gambar" id="gambar" type="file" class="form-control">
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Deskripsi</label>
              <textarea required name="deskripsi" type="text" class="form-control" placeholder="Tambahkan deskripsi"></textarea>
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

  <!-- Main content -->
  <section class="content">

    <!-- @if(session('success'))
        <div class="alert alert-success">
              <b>Berhasil!</b> {{session('success')}}
        </div> 
      @elseif(session('error'))
        <div class="alert alert-danger">
            <b>Maaf!</b> {{session('error')}}
        </div>
      @endif -->
    <!-- Button trigger modal -->
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row" style="margin-left: 10px; margin-top:20px">
            <div class="col mb-3">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Data
              </button>
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
                <th>Content_id</th>
                <th>Judul Content</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
              </tr>

              @foreach($uploads as $upload)
              <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $upload->content_id }}</td>
                <td>{{ $upload->judul }}</td>
                <td>{{ $upload->kategori }}</td>
                <td>{{ $upload->gambar }}</td>
                <td>{{ $upload->deskripsi }}</td>
                <td>
                  <form action="{{route('data-content.destroy', $upload->id)}}" method="POST">
                    <a href="{{ asset('/content/'. $upload->gambar) }}" class="btn btn-warning fas fa-eye"></a>
                    <a href="{{route('data-content.edit', $upload->id)}}" class="btn btn-primary fas fa-edit"></a>
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger fas fa-trash-alt"></button>
                  </form>
                  </form>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
  </section>
  <!-- /.content -->
</main>
<!-- /.content-wrapper -->
@include('pengurus.footer')
<!-- <script>
        //message with toastr
        @if(session()->has('success'))
            toastr.success('{{ session('success') }}', 'BERHASIL!'); 
        @elseif(session()->has('error'))
            toastr.error('{{ session('error') }}', 'GAGAL!'); 
        @endif
    </script> -->
<!-- /.content-wrapper -->
@endsection