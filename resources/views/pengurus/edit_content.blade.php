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
        Edit Pembayaran
      </div>
      <form method="POST" action="{{route('data-content.update', $uploads->id)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" name="old_image" value="{{$uploads->gambar}}">
        <div class="mb-3">
          <label for="" class="form-label">Content_id</label>
          <input name="content_id" value="{{$uploads->content_id}}" type="text" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Judul Content</label>
          <input name="judul" value="{{$uploads->judul}}" type="text" class="form-control">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Kategori</label>
          <input name="kategori" value="{{$uploads->kategori}}" type="text" class="form-control">
        </div>
        <div class="mb-3">
          <label for="gambar" class="form-label">Gambar</label>
          <input name="gambar" id="gambar" type="file" class="form-control-file mt-3">
          <img src="{{ URL::to('/')}}/content/{{ $uploads->gambar }}" class="img-thumbnail" height="10%" width="50%"></img>
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