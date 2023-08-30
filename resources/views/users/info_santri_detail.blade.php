@extends('layouts.main')
<!-- container -->
@section('container')
<!-- Navbar -->
@include('partials.navbar')
<!-- Sidebar -->
@include('partials.sidebar')

<!-- content -->
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-success text-white me-2">
          <a href="{{ URL::previous() }}" style="color:white"><i class="fas fa-arrow-circle-left"></i></a>
        </span> Informasi Santri
      </h3>
    </div>
    <div class="card">
      <div class="card-body">
        <h4>{{$informations->judul}}</h4>
        <p>{{$informations->deskripsi}}</p>
        <div class="text-center">
          <img src="{{ asset('/informasi/'. $informations->gambar) }}" alt="" width="50%">
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  @include('partials.footer')