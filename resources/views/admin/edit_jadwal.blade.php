@include('admin.layouts.head')
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    @include('admin.layouts.sidebar')
    <div class="layout-page">
      @include('admin.layouts.navbar')
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="card">
            <div class="card-body">
              <form method="POST" action="{{route('data-kegiatan.update', $events->id)}}">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{$events->id}}">
                <div class="mb-3">
                  <label for="" class="form-label">Hari Pelaksanaan</label>
                  <input name="hari" value="{{$events->hari}}" type="text" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Kegiatan</label>
                  <input name="kegiatan" value="{{$events->kegiatan}}" type="text" class="form-control">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Waktu Mulai</label>
                  <input required name="mulai" type="time" class="form-control" placeholder="Masukkan waktu pelaksanaan">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Waktu Selesai</label>
                  <input required name="selesai" type="time" class="form-control" placeholder="Masukkan waktu pelaksanaan">
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Tempat</label>
                  <input name="tempat" value="{{$events->tempat}}" type="tempat" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @include('admin.layouts.foot')
    </div>
  </div>
</div>