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
                </span> Detail Riwayat Pembayaran
            </h3>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="invoice-ribbon">
                    <div class="ribbon-inner">{{ $detail->keterangan}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default invoice" id="invoice">
                            <div class="panel-body">

                                <div class="row">
                                    <div class="col-sm-6top-left">
                                        <h3 class="marginright">ALMUNTADHOR</h3>
                                        <span class="marginright">Bukti Pembayaran</span>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">

                                    <div class="col-sm-8 from">
                                        <p class="lead marginbottom">{{ auth()->user()->name}}</p>
                                        <p style="margin-top: -20px">{{ auth()->user()->username}}</p>
                                    </div>

                                    <div class="col-sm-4 text-right payment-details">
                                        <p class="lead marginbottom payment-info">Detail Pembayaran</p>
                                        <p style="margin-top: -15px">Tagihan : {{ $detail->tagihan}}</p>
                                        <p style="margin-top: -15px">Nominal : {{ $detail->nominal}} </p>
                                    </div>

                                </div>

                                <div class="row table-row">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width:50%">Nama Tagihan</th>
                                                    <th class="text-right" style="width:15%">Tgl Bayar</th>
                                                    <th class="text-right" style="width:15%">Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $detail->tagihan}}</td>
                                                    <td class="text-right">{{ $detail->tanggal}}</td>
                                                    <td class="text-right">{{ $detail->nominal}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="margin-top: 30px">
            <div class="card-body text-center">
                <p class="text-center">TERIMAKASIH !</p>
                <button class="btn btn-success"><i class="fa fa-print"></i> Cetak Bukti</button>
            </div>
        </div>

    </div>

    @include('partials.footer')
</div>