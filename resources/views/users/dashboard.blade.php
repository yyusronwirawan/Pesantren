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
          <i class="mdi mdi-home"></i>
        </span> Dashboard
      </h3>

    </div>
    <div class="row">
      @if($setting->maintenance =='AKTIF')
      <div class="px-2 bg-danger mb-3">
        <marquee class="py-3 text-white">Mohon maaf, saat ini sistem sedang Maintenance/Perbaikan - Beberapa fitur mungkin tidak dapat digunakan!</marquee>
      </div>
      @endif
      <div class="col-md-6 grid-margin stretch-card ">
        <div class="card">
          <div class="card-body">
            <h3>WELCOME TO {{$setting->nama_aplikasi}}</h3>
            <p><small>Sistem Monitoring Akademik Santri Perguruan Islam Pesantren Al-Muntadhor</small></p>

            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">
                @foreach($tampilContent as $key => $gallery)
                <div class="carousel-item {{ $key == 0 ? 'active' : ''}}">
                  <img src="{{ URL::to('/')}}/content/{{ $gallery->gambar }}" class="d-block w-100" alt="...">
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body text-center">
            <p class="card-header" style="margin-bottom: 20px;">Menu Utama</p>
            <div class="row justify-content no-gutters text-center">
              <div class="col mb-3" style="margin-right: 5px">
                <a href="/jadwal" class="mb-1   text-white text-center">
                  <span><span><img src="{{ asset('NiceAdmin/') }}/assets/img/jadwal.png" alt="" width="50"></span>
                </a>
                <p class="text-secondary"><small>Jadwal Kegiatan</small></p>
              </div>
              <div class="col mb-3" style="margin-right: 5px">
                <a href="/tagihan" class="mb-1   text-white text-center">
                  <span><img src="{{ asset('NiceAdmin/') }}/assets/img/pembayaran.png" alt="" width="50"></span>
                </a>
                <p class="text-secondary"><small>Pembayaran</small></p>
              </div>
              <div class="col mb-3" style="margin-right: 5px">
                <a href="/riwayat-pembayaran" class="mb-1 text-white text-center">
                  <span><img src="{{ asset('NiceAdmin/') }}/assets/img/history.png" alt="" width="50"></span>
                </a>
                <p class="text-secondary"><small>Riwayat Pembayaran</small></p>
              </div>


            </div>
            <div class="row justify-content no-gutters text-center">
              <div class="col mb-3" style="margin-right: 5px">
                <a href="hafalan-santri" class="mb-1   text-white text-center">
                  <span><img src="{{ asset('NiceAdmin/') }}/assets/img/hafalan.png" alt="" width="50"></span>
                </a>
                <p class="text-secondary"><small>Pencapaian Santri</small></p>
              </div>
              <div class="col mb-3 text-center" style="margin-right: 5px">
                <a href="info-santri" class="mb-1   text-white text-center">
                  <span><img src="{{ asset('NiceAdmin/') }}/assets/img/info.png" alt="" width="50"></span>
                </a>
                <p class="text-secondary"><small>Info Santri</small></p>
              </div>
              <div class="col mb-3 text-center" style="margin-right: 5px">
                <a href="/nilai" class="mb-1   text-white text-center">
                  <span><img src="{{ asset('NiceAdmin/') }}/assets/img/exam.png" alt="" width="50"></i></span>
                </a>
                <p class="text-secondary"><small>Nilai</small></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-header" style="margin-bottom: 20px">Jadwal Kegiatan Hari Ini</div>
            <div class="card-list-group">
              @foreach ($jadwal as $j => $event)
              <div class="list-group-item list-group-item" aria-current="true" style="margin-bottom: 10px">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-1">{{$event->kegiatan}}</h6>
                </div>
                <p class="mb-1">Pukul {{$event->mulai}} - {{$event->selesai}} WIB</p>
                <p><small>Tempat : {{$event->tempat}}</small></p>
                @if ($waktu->toTimeString() >= $event->mulai && $waktu->toTimeString() <= $event->selesai)
                  <p><small class="badge rounded bg-success">Sedang berlansung</small></p>
                  @endif
                  @if ($waktu->toTimeString() < $event->mulai)
                    <p><small class="badge rounded bg-warning">Akan datang</small></p>
                    @endif
                    @if ($waktu->toTimeString() > $event->selesai && $waktu->toTimeString() > $event->mulai)
                    <p><small class="badge rounded bg-danger">Telah selesai</small></p>
                    @endif
              </div>
              @endforeach

            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="card-header" style="margin-bottom: 20px">Pengumuman</div>
            <div class="card-list-group">
              @foreach($pengumuman as $p)
              <div class="list-group-item list-group-item" aria-current="true" style="margin-bottom: 10px">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-1">{{ $p->judul }}</h6>
                </div>
                <p><small>{{ $p->created_at }}</small></p>
                @php
                $isi = substr($p->deskripsi, 0, 90).'...' ;
                @endphp
                <p><small>{{ $isi }}</small></p>
                <div class="text-center">
                  <a href="{{route('pengumuman.detail', $p->id)}}" class="btn btn-sm btn-success">Selengkapnya <i class="fas fa-share"></i></a>
                </div>

              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- selesai content -->
    <!-- Footer -->
    @include('partials.footer')




  </div>
</div>