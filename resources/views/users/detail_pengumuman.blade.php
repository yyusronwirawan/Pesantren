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
                <span class="page-title-icon bg-default-light text-white me-2">
                    <a href="{{ URL::previous() }}" style="color:white"><i class="fas fa-arrow-circle-left"></i></a>
                </span> Detail Pengumuman
            </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>{{$pengumuman->judul}}</h4>
                <p>{{$pengumuman->deskripsi}}</p>
                @if (substr($pengumuman->gambar, -3) == "jpg" or substr($pengumuman->gambar, -3) == "png" or substr($pengumuman->gambar, -3) == "jpeg")
                <div class="text-center">
                    <img src="{{ asset('/content/'. $pengumuman->gambar) }}" alt="" width="50%">
                </div>

                @else
                <a href="{{ asset('/content/'. $pengumuman->gambar) }}" class="btn btn-info"><i class="fas fa-download"></i> Download Surat Pengumuman</a>
                @endif
            </div>



            @include('partials.footer')
        </div>