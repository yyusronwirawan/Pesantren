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
        </span> Gallery
      </h3>
    </div>
    <div class="card">
      <div class="card-body">


        <div class="row">
          @foreach($tampilContent as $gallery)
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body" style="margin-bottom: 20px">
                <img src="{{ URL::to('/')}}/content/{{ $gallery->gambar }}" class="card-img-top" alt="...">
                <h5>{{ $gallery->judul }}</h5>
                <span><small>{{ $gallery->deskripsi }}</small></span>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  @include('umum.footer')
</div>