@include('admin.layouts.head')

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      @include('admin.layouts.sidebar')
      <!-- Layout container -->
      <div class="layout-page">
        @include('admin.layouts.navbar')

        <!-- Content wrapper -->
        <div class="content-wrapper">

          <!-- Modal -->
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  {{-- Form tambah hafalan  --}}
                  <form action="{{route('data-mapel.store')}}" method="POST" enctype="multipart/form-data">
                    {{-- CSRF merupakan keamanan yang disediakan laravel  --}}
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                      <label for="" class="form-label">Mata Pelajaran</label>
                      <input required name="nama_mapel" type="text" class="form-control" placeholder="Masukkan Mata Pelajaran">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Nama Guru</label>
                      <input required name="guru" type="text" class="form-control" placeholder="Masukkan nama guru">
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
              <div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="fas fa-plus-circle"></i> Tambah Data</button>
                <div class="table-responsive">
                  <table class="table table-stiped table-hover">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Mata Pelajaran</th>
                        <th>Nama Guru</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($mataPelajaran as $mapel)
                      <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $mapel->nama_mapel }}</td>
                        <td>{{ $mapel->guru }}</td>
                        <td>
                          <form action="{{route('data-mapel.destroy', $mapel->id)}}" method="POST">
                            <a href="{{route('data-mapel.edit', $mapel->id)}}" class="btn btn-primary fas fa-edit"></a>
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
              <!-- </div>
    <div class="row"> -->

            </div>
          </div>
          <!-- / Content -->
          @include('admin.layouts.foot')