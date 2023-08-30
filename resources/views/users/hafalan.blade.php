@extends('layouts.main')
@section('container')
@include('partials.navbar')
@include('partials.sidebar')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-success text-white me-2">
          <a href="{{ URL::previous() }}" style="color:white"><i class="fas fa-arrow-circle-left"></i></a>
        </span> Capaian Santri
      </h3>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="mb-3">
          <a href="{{route('hafalan-santri.cetak')}}" class="btn btn-sm btn-primary"> <i class="fas fa-download"></i> Download Rekap Capaian (pdf)</a>
        </div>

        <div class="card-header">Capaian Santri</div>
        <div class="tabel table-responsive" style="margin-top: 20px">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Hafalan</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
              </tr>
            </thead>

            <tbody>
              @foreach($riwayatHafalan as $santri)
              <tr>
                <td>{{ $loop->index +1 }}</td>
                <td>{{ $santri->hafalan }}</td>
                <td>{{ $santri->updated_at }}</td>
                <td class="bg-success text-white">{{ $santri->keterangan }}</td>
              </tr>
              @endforeach
            </tbody>

          </table>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="card-header">Capaian yang harus dikuasai santri</div>
        <div class="tabel table-responsive" style="margin-top: 20px">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Capaian Prestasi</th>
                <th>Tingkatan</th>
              </tr>
            </thead>
            @foreach($prestasi as $capaian)
            <tbody>
              <tr>
                <td>{{ $loop->index +1 }}</td>
                <td>{{ $capaian->nama_prestasi }}</td>
                <td>{{ $capaian->tingkatan }}</td>
              </tr>
            </tbody>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
  @include('partials.footer')
</div>