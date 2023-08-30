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
                </span> Rincian Biaya Pembayaran
            </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <p>Silahkan lakukan pembayaran dengan transfer ke salah satu nomor rekening di bawah ini :</p>
                <h4>BRI : 0028-01-011141-53-4 (PIP Al Muntadhor)</h4>
                <h4>BNI : 0028-01-011141-53-4 (PIP Al Muntadhor)</h4>
                <h4>BCA : 0028-01-011141-53-4 (PIP Al Muntadhor)</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <form>
                                <tr>
                                    <th colspan="2" class="text-center"><b>Rincian Pembayaran Bulanan</b></th>
                                </tr>
                                <tr>
                                    <th scope="col">Syahriyyah PIP Al-Muntadhor</th>
                                    <td>Rp. 70.000</td>
                                </tr>
                                <tr>
                                    <th scope="col">Syahriyyah Madrasah Diniyah Al-Muntadhor</th>
                                    <td>Rp. 70.000-</td>
                                </tr>
                                <tr>
                                    <th scope="col">Makan tanpa lauk (2 kali)</th>
                                    <td>Rp. 160.000-</td>
                                </tr>
                                <tr>
                                    <th scope="col"><b>Total Pembayaran</b></th>
                                    <td>Rp. 300.000-,</td>
                                </tr>
                        </thead>
                    </table>
                </div>
                <a class="btn btn-primary form-control" href="/upload" style="margin-top: 20px">Bayar Sekarang</a>
                </form>

            </div>
        </div>
    </div>
    @include('partials.footer')
</div>