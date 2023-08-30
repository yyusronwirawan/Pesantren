@extends('pengurus.main')
<!-- container -->
@section('pengurus')
<!-- Navbar -->
@include('pengurus.navbar')
<!-- Sidebar -->
@include('pengurus.sidebar')
<!-- Content Wrapper. Contains page content -->
<main id="main" class="main">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Nilai</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Modal Download Data-->
  <div class="modal fade" id="DownloadData" tabindex="-1" aria-labelledby="DownloadDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="DownloadDataLabel">Download Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{-- Form tambah hafalan  --}}
          <form action="{{route('data-nilai.cetak')}}" method="POST">
            {{-- CSRF merupakan keamanan yang disediakan laravel  --}}
            @method('POST')
            @csrf
            <div class="mb-3">
              <label for="" class="form-label">Kelas</label>
              <select name="kelas" id="" class="form-select" required>
                <option notselected>Pilih kelas..</option>
                <option value="1 Madrasah">1 Madrasah </option>
                <option value="2 Madrasah">2 Madrasah </option>
                <option value="3 Madrasah">3 Madrasah </option>
                <option value="4 Madrasah">4 Madrasah </option>
                <option value="5 Madrasah">5 Madrasah </option>
                <option value="6 Madrasah">6 Madrasah </option>
              </select>
            </div>
            <div class="mb-3">
              <label for="" class="form-label">Tahun Ajaran</label>
              <select name="tahun" id="" class="form-select" required>
                <option notselected>Pilih tahun ajaran..</option>
                @for ($i=date('Y'); $i>=date('Y')-32; $i-=1)
                <option value='{{$i.'-'.$i+1}}'> {{$i.'-'.$i+1}} </option>
                @endfor
              </select>
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


  <!-- Modal Upload Data-->
  <div class="modal fade" id="UploadData" tabindex="-1" aria-labelledby="UploadDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="UploadDataLabel">Import Data Nilai (Excel)</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{-- Form Import Nilai  --}}
          <form action="{{route('data-nilai.importNilai')}}" method="POST" enctype="multipart/form-data">
            {{-- CSRF merupakan keamanan yang disediakan laravel  --}}
            @method('POST')
            @csrf
            <div class="mb-3">
              <label for="" class="form-label">File Excel</label>
              <input type="file" name="data" class="form-control">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Import</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row" style="margin-left: 10px; margin-top:20px">
            <div class="mb-3">
              <!-- Button trigger modal -->
              <a href="{{route('data-nilai.cetak_all')}}" class="btn btn-primary mb-3">
                <i class="fas fa-download"></i> Dowload Semua Rekap Nilai
              </a>
              <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#DownloadData">
                <i class="fas fa-download"></i> Download Rekap Perkelas
              </button>
              <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#UploadData">
                <i class="fas fa-upload"></i> Import Nilai (Excel)
              </button>
              <form action="{{ route('data-nilai.export') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <button type="submit" class="btn btn-primary mb-3"><i class="bi bi-file-earmark-spreadsheet"> Download Template</i></button>
              </form>
            </div>

            <small>Lihat nilai berdasarkan :</small>
            <form action="{{route('data-nilai')}}" method="POST" enctype="multipart/form-data">
              @method('POST')
              @csrf
              <div class="input-group mb-3">
                <div class="form-outline" style="margin-right: 5px; margin-top: 5px">

                  <select name="kelas" id="" class="form-select" required>
                    <option hidden notselected>Pilih kelas..</option>
                    <option value="1 Madrasah">1 Madrasah </option>
                    <option value="2 Madrasah">2 Madrasah </option>
                    <option value="3 Madrasah">3 Madrasah </option>
                    <option value="4 Madrasah">4 Madrasah </option>
                    <option value="5 Madrasah">5 Madrasah </option>
                    <option value="6 Madrasah">6 Madrasah </option>
                  </select>
                </div>
                <div class="form-outline" style="margin-top: 5px">
                  <select name="tahun" id="" class="form-select" required>
                    <option notselected>Pilih tahun ajaran..</option>
                    @for ($i=date('Y'); $i>=date('Y')-32; $i-=1)
                    <option value='{{$i.'-'.$i+1}}'> {{$i.'-'.$i+1}} </option>
                    @endfor
                  </select>

                </div>
                <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 5px">Tampilkan</button>
              </div>
            </form>

            <div class="table-responsive">
              <table class="table table-striped table-hover" style="vertical-align: middle">
                <tr>
                  <th>No.</th>
                  <th>NIS</th>
                  <th>Nama Santri</th>
                  <th>Kelas</th>
                  <th>Mata Pelajaran</th>
                  <th>Kehadiran</th>
                  <th>Tugas</th>
                  <th>UTS</th>
                  <th>UAS</th>
                  <th>Aksi</th>
                </tr>


                @foreach($nilai as $data)
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ $data->nis }}</td>
                  <td>{{ $data->nama }}</td>
                  <td>{{ $data->kelas }}</td>
                  <td>{{ $data->pelajaran }}</td>
                  <form action="{{route('data-nilai.update', $data->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <td><input type="text" name="kehadiran" placeholder="80 atau 80.5" value="{{ $data->kehadiran }}"></td>
                    <td><input type="text" name="tugas" placeholder="80 atau 80.5" value="{{ $data->tugas }}"></td>
                    <td><input type="text" name="uts" placeholder="80 atau 80.5" value="{{ $data->uts }}"></td>
                    <td><input type="text" name="uas" placeholder="80 atau 80.5" value="{{ $data->uas }}"></td>
                    <td>
                      <button type="submit" class="btn btn-primary">Update</button>
                  </form>
                  </td>
                </tr>
                @endforeach
              </table>

            </div>
          </div>

  </section>
  <!-- /.content -->
</main>
<!-- /.content-wrapper -->
@include('pengurus.footer')