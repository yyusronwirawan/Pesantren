@include('admin.layouts.head')

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      @include('admin.layouts.sidebar')
      <!-- Layout container -->
      <div class="layout-page">
        @include('admin.layouts.navbar')





        <!-- Modal -->
        <div class="modal fade" id="ImportKelas" tabindex="-1" aria-labelledby="ImportKelasLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="ImportKelasLabel">Import Data Update Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Download Format/Template Excelnya <a href="{{ asset('data_nilai_Template.xlsx') }}">Disini</a> </p>
                {{-- Form Import Nilai  --}}
                <form action="{{route('data-kelas.UpdateKelasImport')}}" method="POST" enctype="multipart/form-data">
                  {{-- CSRF merupakan keamanan yang disediakan laravel  --}}
                  @method('POST')
                  @csrf
                  <div class="mb-3">
                    <label for="" class="form-label">File Excel</label>
                    <input type="file" name="data" class="form-control">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Update</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Content wrapper -->
        <div class="content-wrapper">


          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
              <div class="card-body">
                <div class="row mb-3">
                  <label for="cari" class="col-form-label">Cari Data:</label>
                  <form class="d-flex" method="POST" action="{{route('search-admin')}}">
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

                {{-- <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#ImportKelas">
                          <i class="fas fa-upload"></i> Import Data (Excel)
                        </button> --}}
                <div class="table-responsive">
                  <table class="table table-stiped table-hover">
                    <thead>
                      <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Nis</th>
                        <th class="text-center">Nama Lengkap</th>
                        <th class="text-center">Kelas</th>
                        <th class="text-center">Tahun Ajar</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($accounts as $account)
                      <tr>
                        <td class="text-center">{{ $loop->index + 1 }}</td>
                        <td>{{ $account->username }}</td>
                        <td>{{ $account->name }}</td>
                        <form action="{{route('data-kelas.update', $account->id)}}" method='post'>
                          @method('PUT')
                          @csrf
                          <td>
                            <select class="form-select" name="kelas">
                              <option selected>{{ $account->kelas}} </option>
                              <option value="1 Madrasah">1 Madrasah </option>
                              <option value="2 Madrasah">2 Madrasah </option>
                              <option value="3 Madrasah">3 Madrasah </option>
                              <option value="4 Madrasah">4 Madrasah </option>
                              <option value="5 Madrasah">5 Madrasah </option>
                              <option value="6 Madrasah">6 Madrasah </option>
                            </select>
                          </td>
                          <td>
                            <select class="form-select" name="tahun_ajar">
                              @for ($i=date('Y'); $i>=date('Y')-32; $i-=1)
                              <option value='{{$i.'-'.$i+1}}'> {{$i.'-'.$i+1}} </option>
                              @endfor


                            </select>
                          </td>


                          <td><button type="submit" class="btn btn-sm btn-success">Update</button></td>
                      </tr>
                      </form>
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