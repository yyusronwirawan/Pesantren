@extends('pengurus.main')
<!-- container -->
@section('pengurus')
<!-- Navbar -->
@include('pengurus.navbar')
<!-- Sidebar -->
@include('pengurus.sidebar')
<main id="main" class="main">
  <div class="card shadow">
    <div class="card-body">
      <div class="text-center display-4">
        Edit Data Santri
      </div>
      <form method="POST" action="{{route('data-santri.update', $datas->id)}}">
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$datas->id}}">
        <div class="mb-3">
          <label for="" class="form-label">NIS Santri</label>
          <input name="nis" value="{{$datas->nis}}" type="text" class="form-control" placeholder="Masukkan NIS Santri">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Nama Lengkap Santri</label>
          <input name="nama" value="{{$datas->nama}}" type="text" class="form-control" placeholder="Masukkan nama lengkap santri">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Tanggal Lahir</label>
          <input name="tgl_lahir" value="{{$datas->tgl_lahir}}" type="date" class="form-control" placeholder="Masukkan tanggal lahir">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Angkatan</label>
          <input name="angkatan" value="{{$datas->angkatan}}" type="text" class="form-control" placeholder="Masukkan angkatan">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Alamat Lengkap</label>
          <input name="alamat" value="{{$datas->alamat}}" type="text" class="form-control" placeholder="Masukkan alamat lengkap">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</main>

@include('pengurus.footer')
@endsection