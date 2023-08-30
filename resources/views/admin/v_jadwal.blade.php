@include('admin.layouts.head')
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    @include('admin.layouts.sidebar')
    <div class="layout-page">
      @include('admin.layouts.navbar')
      <div class="content-wrapper">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{route('data-kegiatan.store')}}" method="POST">
                  @method('POST')
                  @csrf
                  <div class="mb-3">
                    <label for="" class="form-label">Hari</label>
                    <select name="hari" class="form-select" aria-label="Default select example" required>
                      <option hidden selected>Pilih hari pelaksanaan</option>
                      <option value="ahad">Ahad</option>
                      <option value="senin">Senin</option>
                      <option value="selasa">Selasa</option>
                      <option value="rabu">Rabu</option>
                      <option value="kamis">Kamis</option>
                      <option value="jumat">Jum'at</option>
                      <option value="sabtu">Sabtu</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Kegiatan</label>
                    <input required name="kegiatan" type="text" class="form-control" placeholder="Masukkan kegiatan">
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
                    <input name="tempat" type="text" class="form-control" placeholder="Masukkan tempat kegiatan" required>
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
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="card">
            <div class="card-body">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-plus-circle"></i> Tambah Data</button>
              <div class="table-responsive">
                <table class="table table-stiped table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">No.</th>
                      <th class="text-center">Hari Pelaksanaan</th>
                      <th class="text-center">Kegiatan</th>
                      <th class="text-center">Waktu</th>
                      <th class="text-center">Tempat</th>
                      <th class="text-center">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($events as $event)
                    <tr>
                      <td class="text-center">{{ $loop->index + 1 }}</td>
                      <td>{{ $event->hari }}</td>
                      <td>{{ $event->kegiatan }}</td>
                      <td>{{ $event->mulai }} - {{ $event->selesai }}</td>
                      <td>{{ $event->tempat }}</td>
                      <td class="text-center">
                        <form action="{{route('data-kegiatan.destroy', $event->id)}}" method="POST">
                          <a href="{{route('data-kegiatan.edit', $event->id)}}" class="btn btn-primary fas fa-edit"></a>
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger fas fa-trash-alt"></button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="page-bottom" style="margin: 20px">
              <br>
              <!-- pagination -->
              Current Page: {{ $events->currentPage() }}<br>
              Jumlah Data: {{ $events->total() }}<br>
              Data perhalaman: {{ $events->perPage() }}<br>
              <br>
              {{ $events->links() }}
            </div>
          </div>
        </div>
        @include('admin.layouts.foot')
      </div>
    </div>
  </div>
</div>