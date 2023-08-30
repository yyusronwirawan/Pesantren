@extends('pengurus.main')
@section('pengurus')
@include('pengurus.navbar')
@include('pengurus.sidebar')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>
    <section class="section">
        @if (auth()->user()->level == "pengurus")
        <div class="row">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2" style="margin-top: 30px">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                            <div class="col-sm-5">
                                <h5 class="card-title">Data Santri</h5>
                                <h5 style="margin-top: -10px">{{ $santri }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2" style="margin-top: 30px">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                            <div class="col-sm-7">
                                <h5 class="card-title">Data Pembayaran</h5>
                                <h5 style="margin-top: -10px">{{ $pembayaran }}</h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif
        @if (auth()->user()->level == "pendidik")
        <div class="row">

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2" style="margin-top: 30px">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                            <div class="col-sm-7">
                                <h5 class="card-title">Data Santri</h5>
                                <h5 style="margin-top: -10px">{{ $santri }}</h5>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2" style="margin-top: 30px">
                                <i class="bi bi-journal-text fa-3x"></i>
                            </div>
                            <div class="col-sm-5">
                                <h5 class="card-title">Data Guru</h5>
                                <h5 style="margin-top: -10px">{{ $guru }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <div class="card-body text-center">
                    <p class="card-header" style="margin-bottom: 20px;">Menu Utama</p>
                    <div class="row justify-content no-gutters text-center">
                        @if (auth()->user()->level == "pengurus")
                        <div class="col mb-3" style="margin-right: 5px">
                            <a href="/data-tagihan" class="mb-1 bg-gradient-primary  text-white text-center">
                                <span><img src="{{ asset('NiceAdmin/') }}/assets/img/pembayaran.png" alt="" width="50"></span>
                            </a>
                            <p class="text-secondary"><small>Kelola Tagihan</small></p>
                        </div>
                        <div class="col mb-3" style="margin-right: 5px">
                            <a href="/data-pembayaran" class="mb-1 bg-gradient-primary  text-white text-center">
                                <span><img src="{{ asset('NiceAdmin/') }}/assets/img/pembayaran.png" alt="" width="50"></span>
                            </a>
                            <p class="text-secondary"><small>Kelola Pembayaran</small></p>
                        </div>
                        <div class="col mb-3" style="margin-right: 5px">
                            <a href="data-hafalan" class="mb-1 bg-gradient-primary  text-white text-center">
                                <span><span><img src="{{ asset('NiceAdmin/') }}/assets/img/jadwal.png" alt="" width="50"></span>
                            </a>
                            <p class="text-secondary"><small>Kelola Hafalan</small></p>
                        </div>
                        <div class="col mb-3 text-center" style="margin-right: 5px">
                            <a href="/data-informasi" class="mb-1 bg-gradient-primary  text-white text-center">
                                <span><img src="{{ asset('NiceAdmin/') }}/assets/img/info.png" alt="" width="50"></span>
                            </a>
                            <p class="text-secondary"><small>Kelola Informasi Pribadi</small></p>
                        </div>
                        @endif
                        @if (auth()->user()->level == "pendidik")
                        <div class="row justify-content no-gutters text-center">
                            <div class="col mb-3" style="margin-right: 5px">
                                <a href="/data-nilai" class="mb-1 bg-gradient-primary  text-white text-center">
                                    <span><img src="{{ asset('NiceAdmin/') }}/assets/img/exam.png" alt="" width="50"></span>
                                </a>
                                <p class="text-secondary"><small>Kelola Nilai</small></p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('pengurus.footer')
@endsection