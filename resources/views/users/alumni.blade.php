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
        </span> Riwayat Pembayaran
      </h3>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <th scope="col">NO</th>
              <th scope="col">NAMA LENGKAP</th>
              <th scope="col">ALAMAT</th>
            </thead>

            <tbody>
              <td></td>
              <td></td>
              <td></td>
            </tbody>
          </table>
        </div>
      </div>
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