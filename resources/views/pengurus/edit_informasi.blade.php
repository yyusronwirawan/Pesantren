@extends('pengurus.main')
<!-- container -->
@section('pengurus')
<!-- Navbar -->
@include('pengurus.navbar')
<!-- Sidebar -->
@include('pengurus.sidebar')
<main id="main" class="main">
  <div class="card shadow">
    <div class="card-body mt-3">
      <form method="POST" action="{{route('data-informasi.update', $uploads->id)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" name="old_image" value="{{$uploads->gambar}}">
        <div class="mb-3">
          <label for="" class="form-label">Penerima Informasi</label>
          <input name="penerima" value="{{$uploads->penerima}}" type="text" class="form-control">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Judul Informasi</label>
          <input name="judul" value="{{$uploads->judul}}" type="text" class="form-control">
        </div>
        <div class="mb-3">
          <label for="gambar" class="form-label">File Informasi</label>
          <input name="gambar" id="gambar" type="file" class="form-control-file mt-3">
          <img src="{{ URL::to('/')}}/informasi/{{ $uploads->gambar }}" class="img-thumbnail" height="10%" width="50%"></img>
          <input type="hidden" class="form-control-file mt-3" name="old_image" value="{{ $uploads->gambar }}">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Deskripsi</label>
          <input name="deskripsi" value="{{$uploads->deskripsi}}" type="text" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</main>

@include('pengurus.footer')
@endsection