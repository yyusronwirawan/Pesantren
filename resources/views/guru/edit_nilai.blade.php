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
        Edit Nilai
      </div>
      <form method="POST" action="{{route('data-nilai.update', $santriMapel->id)}}">
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$santriMapel->id}}">
        <div class="mb-3">
          <label for="" class="form-label">Nama Santri</label>
          <input name="santri_id" value="{{$santriMapel->santri_id}}" type="text" class="form-control">
        </div>
        <div class="mb-3">
          <label for="" class="form-label" hidden>Mata Pelajaran</label>
          <input name="mapel_id" value="{{$santriMapel->mapel_id}}" type="text" class="form-control" hidden>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Kehadiran</label>
          <input name="kehadiran" value="{{$santriMapel->kehadiran}}" type="text" class="form-control">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Tugas</label>
          <input name="tugas" value="{{$santriMapel->tugas}}" type="text" class="form-control">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">UTS</label>
          <input name="uts" value="{{$santriMapel->uts}}" type="text" class="form-control">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">UAS</label>
          <input name="uas" value="{{$santriMapel->uas}}" type="text" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</main>

@include('pengurus.footer')
@endsection