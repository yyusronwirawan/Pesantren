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

        <form action="{{route('nilai.cetak_nilai')}}" method="POST" enctype="multipart/form-data">
          @method('POST')
          @csrf
          <input type="text" name="kelas" value="{{$kelas}}" hidden>
          <input type="text" name="tahun" value="{{$tahun}}" hidden>
          <button type="submit" name="submit" class="btn btn-sm btn-success">Download Rekap Nilai (Pdf)</button>
        </form>
        <small>Lihat nilai berdasarkan :</small>
        <form action="{{route('nilai.tampil_nilai')}}" method="POST" enctype="multipart/form-data">
          @method('POST')
          @csrf
          <div class="input-group mb-3">
            <div class="form-outline" style="margin-right: 5px; margin-top: 5px">

              <select name="kelas" id="" class="form-select">
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
              <select name="tahun" id="" class="form-select">
                <option notselected>Pilih tahun ajaran..</option>
                @for ($i=date('Y'); $i>=date('Y')-32; $i-=1)
                <option value='{{$i.'-'.$i+1}}'> {{$i.'-'.$i+1}} </option>
                @endfor
              </select>

            </div>
            <button type="submit" class="btn btn-sm btn-primary" style="margin-top: 5px">Tampilkan</button>
          </div>
        </form>
        <div class="table table-responsive">
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



</div>
</div>