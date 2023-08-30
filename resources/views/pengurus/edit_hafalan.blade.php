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
      <form method="POST" action="{{route('data-hafalan.update', $hafalan->id)}}">
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$hafalan->id}}">
        <div class="mb-3">
          <label for="" class="form-label">NIS Santri</label>
          <input name="nis" value="{{$hafalan->nis}}" type="text" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Hafalan Surat</label>
          <input name="hafalan" value="{{$hafalan->hafalan}}" type="text" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Keterangan</label>
          <select name="keterangan" class="form-select" aria-label="Default select example">
            <option hidden selected>{{$hafalan->keterangan}}</option>
            <option value="Lulus">Lancar</option>
            <option value="Mengulang">Belum Lancar</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</main>

@include('pengurus.footer')
@endsection