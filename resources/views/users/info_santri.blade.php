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
            <ul class="list-unstyled">
              @foreach($informations as $information)
              <div class="card-list-group">
                <div class="list-group-item list-group-item" aria-current="true" style="margin-bottom: 10px">
                  <div class="d-flex w-100 justify-content-between">
                    <li class="media">
                      <h5 class="mt-0 mb-1">{{ $information->judul }}</h5>
                      <small>{{ $information->created_at }}</small>
                      <img src="{{ URL::to('/')}}/informasi/{{ $information->gambar }}" class="img-thumbnail" height="10%" width="auto" />
                      <div class="media-body">

                        @php
                        $isi = substr($information->deskripsi, 0, 150)."...";
                        @endphp
                        <p>{{ $isi }}</p>
                        <a href="{{route('info-santri.detail', $information->id)}}" class="btn btn-sm btn-success" style="float: right">Selengkapnya <i class="fas fa-share"></i></a>

                      </div>
                    </li>
                  </div>
                </div>
              </div>
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