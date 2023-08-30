@extends('layouts.main')
<!-- container -->
@section('container')
<!-- Navbar -->
@include('partials.navbar')
<!-- Sidebar -->
@include('partials.sidebar')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-success text-white me-2">
          <a href="{{ URL::previous() }}" style="color:white"><i class="fas fa-arrow-circle-left"></i></a>
        </span> Rekap Nilai
      </h3>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col mb-3">
            <!-- Button trigger modal -->
            <a href="{{route('nilai.cetak_nilai_all')}}" class="btn btn-sm btn-primary mb-2"> <i class="fas fa-download"></i> Semua Rekap Nilai (pdf)</a>
            <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#DownloadData">
              <i class="fas fa-download"></i> Download Rekap Perkelas
            </button>
            <button type="button" class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#DownloadDataPelajaran">
              <i class="fas fa-download"></i> Download Rekap Perpelajaran
            </button>
          </div>
        </div>

        <small>Lihat nilai berdasarkan :</small>
        <form action="{{route('nilai')}}" method="POST" enctype="multipart/form-data">
          @method('POST')
          @csrf
          <div class="input-group mb-3">
            <div class="form-outline" style="margin-right: 5px; margin-top: 5px">

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

        <ul class="list-group d-block d-sm-none">
          @foreach($tampilUser as $show)
          <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
              {{ $show->pelajaran }}
              <span class="badge badge-light badge-pill text-black"><i class="fas fa-ellipsis-v"></i></span>
            </div>
            @php
            $nilai_akhir = ($show->kehadiran + $show->tugas + $show->uts + $show->uas) / 4
            @endphp

            @if($nilai_akhir == "0")
            <p><small>Nilai Akhir : - </small></p>
            @else
            <p><small>Nilai Akhir : {{$nilai_akhir}} </small></p>
            @endif

          </li>
          @endforeach
        </ul>

        <div class="table table-responsive d-none d-none d-sm-block">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Mata Pelajaran</th>
                <th class="text-center">Kehadiran</th>
                <th class="text-center">Tugas</th>
                <th class="text-center">UTS</th>
                <th class="text-center">UAS</th>
                <th class="text-center">Nilai Akhir</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tampilUser as $show)
              <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $show->pelajaran }}</td>
                <td class="text-center">{{ $show->kehadiran }}</td>
                <td class="text-center">{{ $show->tugas }}</td>
                <td class="text-center">{{ $show->uts }}</td>
                <td class="text-center">{{ $show->uas }}</td>
                <td class="text-center">
                  @php
                  $nilai_akhir = ($show->kehadiran + $show->tugas + $show->uts + $show->uas) / 4
                  @endphp
                  {{$nilai_akhir}}
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- selesai content -->
  <!-- Footer -->
  @include('partials.footer')


  <!-- Modal Download Perkelas-->
  <div class="modal fade" id="DownloadData" tabindex="-1" aria-labelledby="DownloadDataLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="DownloadDataLabel">Download Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{-- Form tambah hafalan  --}}
          <form action="{{route('nilai.cetak_nilai')}}" method="GET">
            {{-- CSRF merupakan keamanan yang disediakan laravel  --}}
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
                <option notselected>Pilih tahun ajar..</option>
                @for ($i=date('Y'); $i>=date('Y')-32; $i-=1)
                <option value='{{$i.'-'.$i+1}}'> {{$i.'-'.$i+1}} </option>
                @endfor
              </select>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Download</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Download Perpelajaran-->
  <div class="modal fade" id="DownloadDataPelajaran" tabindex="-1" aria-labelledby="DownloadDataPelajaranLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="DownloadDataPelajaranLabel">Rekap Perpelajaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          {{-- Form tambah hafalan  --}}
          <form action="{{route('nilai.cetak_nilai_pelajaran')}}" method="GET">
            {{-- CSRF merupakan keamanan yang disediakan laravel  --}}

            <div class="mb-3">
              <label for="" class="form-label">Pelajaran</label>
              <select name="pelajaran" id="" class="form-select" required>
                <option notselected>Pilih Pelajaran..</option>
                @foreach ($mapel as $mp)
                <option value="{{$mp->kelas}}">{{$mp->kelas}} </option>
                @endforeach
              </select>
            </div>
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
                <option notselected>Pilih tahun ajar..</option>
                @for ($i=date('Y'); $i>=date('Y')-32; $i-=1)
                <option value='{{$i.'-'.$i+1}}'> {{$i.'-'.$i+1}} </option>
                @endfor
              </select>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Download</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>