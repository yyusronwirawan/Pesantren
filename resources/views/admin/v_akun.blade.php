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
                  <form action="{{route('data-akun.store')}}" method="POST">
                    {{-- CSRF merupakan keamanan yang disediakan laravel  --}}
                    @method('POST')
                    @csrf
                    <div class="mb-3">
                      <label for="" class="form-label">Nama Lengkap</label>
                      <input required name="name" type="text" class="form-control" placeholder="Masukkan nama lengkap santri">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Username</label>
                      <input required name="username" type="text" class="form-control" placeholder="Masukkan NIS santri">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Kelas</label>
                      <select class="form-select" name="kelas">
                        <option hidden notselected>Pilih kelas.. </option>
                        <option value="1 Madrasah">1 Madrasah </option>
                        <option value="2 Madrasah">2 Madrasah </option>
                        <option value="3 Madrasah">3 Madrasah </option>
                        <option value="4 Madrasah">4 Madrasah </option>
                        <option value="5 Madrasah">5 Madrasah </option>
                        <option value="6 Madrasah">6 Madrasah </option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Angkatan</label>
                      <input required name="angkatan" type="text" class="form-control" placeholder="Masukkan Angkatan">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Tahun Ajaran</label>
                      <select class="form-select" name="tahun_ajar">
                        <option hidden notselected>Pilih tahun ajar.. </option>
                        @for ($i=date('Y'); $i>=date('Y')-32; $i-=1)
                        <option value='{{$i.'-'.$i+1}}'> {{$i.'-'.$i+1}} </option>
                        @endfor
                      </select>
                    </div>

                    <div class="mb-3">
                      <label for="" class="form-label">Level</label>
                      <select name="level" class="form-select" aria-label="Default select example">
                        <option hidden selected>Pilih level users</option>
                        <option value="admin">Admin</option>
                        <option value="pengurus">Pengurus</option>
                        <option value="pendidik">Pendidik</option>
                        <option value="santri">Santri</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Email</label>
                      <input required name="email" type="email" class="form-control" placeholder="Masukkan angkatan santri">
                    </div>
                    <div class="mb-3">
                      <label for="" class="form-label">Password</label>
                      <input required name="password" type="password" class="form-control" placeholder="Masukkan alamat lengkap">
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
                        <th class="text-center">No.</th>
                        <th class="text-center">Nama Lengkap</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Level</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($accounts as $account)
                      <tr>
                        <td class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $account->name }}</td>
                        <td>{{ $account->username }}</td>
                        <td>{{ $account->level }}</td>
                        <td>{{ $account->email }}</td>
                        <td class="text-center">
                          <form action="{{route('data-akun.destroy', $account->id)}}" method="POST">
                            <a href="{{route('data-akun.edit', $account->id)}}" class="btn btn-primary fas fa-edit"></a>
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
              <div class="page-bottom" style="margin: 20px">
                <br />
                <!-- pagination -->
                Current Page: {{ $accounts->currentPage() }}<br>
                Jumlah Data: {{ $accounts->total() }}<br>
                Data perhalaman: {{ $accounts->perPage() }}<br>
                <br>
                {{ $accounts->links() }}
              </div>
            </div>
          </div>
          <!-- / Content -->
          @include('admin.layouts.foot')