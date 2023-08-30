@extends('layouts.main')
@section('container')
@include('umum.navbar')
@include('umum.sidebar')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-success text-white me-2">
          <a href="{{ URL::previous() }}" style="color:white"><i class="fas fa-arrow-circle-left"></i></a>
        </span> Informasi
      </h3>
    </div>
    <div class="row">
      <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title text-center" style="margin-bottom: 20px;">Informasi Umum</p>
            @foreach($tampilContent as $gallery)
            <div class="card-body bg-gradient-light" style="margin-bottom: 20px">
              <h5>{{ $gallery->judul }}</h5>
              <span><small>Terbit : {{ $gallery->created_at }}</small></span>
              @php
              $isi = substr($gallery->deskripsi, 0, 90).'...' ;
              @endphp
              <p>{{ $isi }}</p>
              <div class="text-center">
                <a href="{{route('info.detail', $gallery->id)}}" class="btn btn-light">Lihat Selengkapnya</a>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h3>Arsip Informasi</h3>
            <div class="list-group" style="margin-bottom: 50px">
              @foreach($tampilContent as $gallery)
              <a href="#" class="list-group-item list-group-item-action"> {{ $gallery->judul }}</a>
              @endforeach
            </div>
            <h3>Media Sosial Resmi</h3>
            <p><small><i class="fab fa-instagram"></i> instagram : @pesantren_almuntadhor</small></p>
            <p><small><i class="fab fa-facebook"></i> Facebook : pesantren almuntadhor</small></p>
            <p><small><i class="fab fa-youtube"></i> Youtube : almuntadhor.id</small></p>
            <br>
            <h3>Alamat</h3>
            <p>Jl. Merdeka No. 61 RT. 02 RW. 03 Desa Babakan Kecamatan Ciwaringin Kabupaten Cirebon 45167</p>
            <iframe class="responsive" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.658509229347!2d108.36614261404884!3d-6.68915276725453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6edefcaad37c35%3A0x163a0af6459df031!2sPondok%20Pesantren%20Al-muntadhor!5e0!3m2!1sid!2sid!4v1643802793550!5m2!1sid!2sid" width="250" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
          </div>
        </div>
      </div>
    </div>
    @include('umum.footer')
  </div>
</div>