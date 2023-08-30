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
    <div class="row">
      <div class="col-md-7 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h5>Informasi Santri</h5>
            <ul class="list-unstyled">
              @foreach($informations as $information)
              <li class="media">
                <img src="{{ URL::to('/')}}/informasi/{{ $information->gambar }}" class="img-thumbnail" height="10%" width="50%"></img>
                <div class="media-body">
                  <h5 class="mt-0 mb-1">{{ $information->judul }}</h5>
                  <small>{{ $information->created_at }}</small>
                  <p>{{ $information->deskripsi }}</p>
                  <!-- <a href="#" class="btn btn-gradient-success">Selengkapnya..</a> -->
                </div>
              </li>
              @endforeach
            </ul>


          </div>
        </div>
      </div>
      <div class="col-md-5 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h5>Arsip Informasi</h5>
            <div class="list-group" style="margin-bottom: 50px">
              @foreach($informations as $information)
              <a href="#" class="list-group-item list-group-item-action"> {{ $information->judul }}</a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    @include('partials.footer')