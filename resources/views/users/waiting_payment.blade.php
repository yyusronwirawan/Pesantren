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
        </span> Proses Pembayaran
      </h3>
    </div>
    <div class="card">
      <div class="card-body">
        <ul class="list-group list-group-flush">
          @foreach ($data_bayar as $bayar)
          @if ($bayar->status =='pending')
          @if ($bayar->payment_type == 'cstore')
          <div class="text-center mb-3">
            <h4>Kode Bayar</h4>
            <h4><b>{{$bayar->payment_code}}</b></h4>
          </div>
          <li class="list-group-item">Tagihan
            <p><b>{{$bayar->tagihan}}</b></p>
          </li>
          <li class="list-group-item">Nominal
            <p><b>Rp. {{number_format($bayar->gross_amount)}}</b></p>
          </li>
          <li class="list-group-item">Metode
            <p class="text-uppercase"><b>Indomaret/Alfamart</b></p>
          </li>

          @endif
          @if ($bayar->payment_type == 'bank_transfer')
          <div class="text-center mb-3">
            <h4>Nomor Rekening / Virtual Account</h4>
            <h4><b>{{$bayar->va_number}}</b></h4>
          </div>
          <li class="list-group-item">Tagihan
            <p><b>{{$bayar->tagihan}}</b></p>
          </li>
          <li class="list-group-item">Nominal
            <p><b>Rp. {{number_format($bayar->gross_amount)}}</b></p>
          </li>
          <li class="list-group-item">Methode
            <p class="text-uppercase"><b>{{$bayar->bank}}</b></p>
          </li>

          @endif
          @if ($bayar->payment_type == 'echannel')
          <div class="text-center mb-3">
            <div class="row">
              <div class="col">
                <h4>Kode Perusahaan</h4>
                <h4><b>{{$bayar->kode_bank}}</b></h4>
              </div>
              <div class="col">
                <h4>Kode Pembayaran</h4>
                <h4><b>{{$bayar->bill_key}}</b></h4>
              </div>
            </div>
          </div>
          <li class="list-group-item">Tagihan
            <p><b>{{$bayar->tagihan}}</b></p>
          </li>
          <li class="list-group-item">Nominal
            <p><b>Rp. {{number_format($bayar->gross_amount)}}</b></p>
          </li>
          <li class="list-group-item">Methode
            <p class="text-uppercase"><b>Bank Mandiri</b></p>
          </li>
          @endif

          <li class="list-group-item text-center bg-warning">Mohon Dibayarkan sebelum : <b>{{$bayar->created_at->isoFormat('DD')+1}}-{{$bayar->created_at->format('m-Y')}} Pukul : {{$bayar->created_at->format('H:i:s')}}</b></li>

          <li class="list-group-item text-center"><a href="/waiting-payment/{{$bayar->order_id}}" class="btn btn-info"> Cek status pembayaran</a></li>
        </ul>
        <div class="accordion mt-4" id="accordionPanelsStayOpenExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                Panduan Pembayaran
              </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
              <div class="accordion-body">
                @foreach ($data_bayar as $bayar)
                @if ($bayar->payment_type == 'cstore')
                <ol>
                  <li><b>VIA INDOMARET</b></li>
                  <ul class="mb-4">
                    <li>Pergi ke Indomaret terdekat dan sampaikan pada kasir bahwa anda ingin melalukan pembayaran Midtrans.</li>
                    <li> Berikan
                      Kode Pembayaran Anda ke kasir</li>
                    <li>Kasir Indomaret akan mengkonfirmasi
                      transaksi dengan menanyakan Jumlah
                      Tagihan dan Nama Toko.</li>
                    <li>
                      Bayar sesuai Jumlah Tagihan Anda
                    </li>
                    <li>Setelah pembayaran diterima, Anda
                      akan menerima konfirmasi yang dikirimkan ke email</li>
                    <li>Simpanlah struk transaksi Indomaret
                      Anda sebagai bukti pembayaran</li>

                  </ul>
                  <li><b>VIA ALFAMART</b></li>
                  <ul class="mb-4">
                    <li>Pergi ke Alfamart terdekat dan sampaikan pada kasir bahwa anda ingin melalukan pembayaran Midtrans.</li>
                    <li> Berikan
                      Kode Pembayaran Anda ke kasir</li>
                    <li>Kasir Alfamart akan mengkonfirmasi
                      transaksi dengan menanyakan Jumlah
                      Tagihan dan Nama Toko.</li>
                    <li>
                      Bayar sesuai Jumlah Tagihan Anda
                    </li>
                    <li>Setelah pembayaran diterima, Anda
                      akan menerima konfirmasi yang dikirimkan ke email</li>
                    <li>Simpanlah struk transaksi Alfamart
                      Anda sebagai bukti pembayaran</li>

                  </ul>
                </ol>
                @endif
                @if ($bayar->bank == 'bca')
                <b>VIA BANK TRANSFER BCA</b>
                <ul>
                  <li>ATM BCA</li>
                  <ul>
                    <li>Pilih transaksi lainnya pada menu utama.</li>
                    <li>Pilih transfer.</li>
                    <li>Pilih ke rekening BCA Virtual Account.</li>
                    <li>Masukkan nomor BCA virtual account <b>{{$bayar->va_number}}</b>.</li>
                    <li> Masukkan jumlah yang akan dibayar, lalu konfirmasi.</li>
                    <li> Pembayaran selesai.</li>
                  </ul>
                  <li>Klik BCA</li>
                  <ul>
                    <li>Pilih Transfer Dana. </li>
                    <li>Pilih Transfer ke BCA Virtual Account.</li>
                    <li> Masukkan nomor BCA Virtual Account <b>{{$bayar->va_number}}</b>.</li>
                    <li>Masukkan jumlah yang akan dibayar <b>{{$bayar->gross_amount}}</b>.</li>
                    <li>Konfirmasi pembayaran.</li>
                    <li>Pembayaran selesai.</li>
                  </ul>
                  <li>m-BCA</li>
                  <ul>
                    <li>Pilih m-Transfer.</li>
                    <li>Pilih BCA Virtual Account.</li>
                    <li>Masukkan nomor BCA Virtual Account <b>{{$bayar->va_number}}</b>.</li>
                    <li>Masukkan jumlah yang akan dibayar <b>{{$bayar->gross_amount}}</b>.</li>
                    <li>Konfirmasi pembayaran.</li>
                    <li>Pembayaran selesai.</li>
                  </ul>
                </ul>
                @endif
                @if ($bayar->payment_type == 'echannel')
                <b>VIA BANK TRANSFER MANDIRI</b>
                <ul>
                  <li>ATM MANDIRI</li>
                  <ul>
                    <li>Pilih bayar/beli pada menu utama.</li>
                    <li>Pilih lainnya.</li>
                    <li>Pilih multi payment.</li>
                    <li>Masukkan kode perusahaan Midtrans <b>70012</b>.</li>
                    <li>Masukkan kode pembayaran <b>{{$bayar->bill_key}}</b>, lalu konfirmasi.</li>
                    <li>Pembayaran selesai.</li>
                  </ul>
                  <li>Internet Banking</li>
                  <ul>
                    <li>Pilih bayar pada menu utama.</li>
                    <li>Pilih multi payment.</li>
                    <li>Pilih dari rekening.</li>
                    <li>Pilih Midtrans di bagian penyedia jasa.</li>
                    <li>Masukkan kode pembayaran <b>{{$bayar->bill_key}}</b>, lalu konfirmasi.</li>
                    <li>Pembayaran selesai.</li>
                  </ul>
                </ul>
                @endif
                @if ($bayar->bank == 'bni')
                <b>VIA BANK TRANSFER BNI</b>
                <ul>
                  <li>ATM BNI</li>
                  <ul>
                    <li>Pilih Menu Lain pada menu utama.</li>
                    <li>Pilih Transfer.</li>
                    <li>Pilih Dari Rekening Tabungan.</li>
                    <li>Pilih Ke Rekening BNI.</li>
                    <li>Masukkan Nomor Rekening Pembayaran.</li>
                    <li>Masukkan jumlah yang akan dibayar.</li>
                    <li>Konfirmasi pembayaran</li>
                    <li>Pembayaran selesai.</li>
                  </ul>
                  <li>Internet Banking</li>
                  <ul>
                    <li>Pilih Transaksi > Info & Administrasi Transfer.</li>
                    <li>Pilih Atur Rekening Tujuan.</li>
                    <li>Masukkan informasi rekening > Konfirmasi.</li>
                    <li>Pilih Transfer > Transfer ke Rekening BNI.</li>
                    <li>Masukkan detail pembayaran > Konfirmasi.</li>
                    <li>Pembayaran selesai.</li>
                  </ul>
                  <li>Mobile Banking</li>
                  <ul>
                    <li> Pilih Transfer.</li>
                    <li>Pilih Virtual Account Billing.</li>
                    <li>Pilih rekening debit yang akan digunakan.</li>
                    <li>Masukkan Nomor Virtual Account.</li>
                    <li>Konfirmasi pembayaran.</li>
                    <li>Pembayaran selesai.</li>
                  </ul>
                </ul>
                @endif
                @if ($bayar->bank == 'bri')
                <b>VIA BANK TRANSFER BRI</b>
                <ul style="list-style-type: upper-alpha">
                  <ul>
                    <li>ATM BRI</li>
                    <ul class="mb-4">
                      <li>Pilih transaksi lainnya pada menu utama.</li>
                      <li>Pilih pembayaran.</li>
                      <li>Pilih lainnya.</li>
                      <li>
                        Pilih BRIVA.
                      </li>
                      <li>Masukkan nomor BRIVA / Nomor VA, lalu konfirmasi.</li>
                      <li>Pembayaran selesai.</li>

                    </ul>
                    <li>IB BRI</li>
                    <ul class="mb-4">
                      <li>Pilih pembayaran & pembelian.
                      </li>
                      <li>
                        Pilih BRIVA.
                      </li>
                      <li>Masukkan nomor BRIVA / Nomor VA, lalu konfirmasi.</li>
                      <li>Pembayaran selesai.</li>

                    </ul>
                    <li>BRImo</li>
                    <ul class="mb-4">
                      <li>Pilih pembayaran & pembelian.
                      </li>
                      <li>
                        Pilih BRIVA.
                      </li>
                      <li>Masukkan nomor BRIVA / Nomor VA, lalu konfirmasi.</li>
                      <li>Pembayaran selesai.</li>

                    </ul>
                  </ul>
                </ul>
                @endif
                @endforeach


              </div>
            </div>
          </div>

        </div>
        @else
        <div class="text-center">
          <img src="{{ asset('NiceAdmin/') }}/assets/img/success.png" alt="" width="100px">
          <p>Pembayaran telah berhasil !</p>
          <a href="/cetak-kwitansi/{{ $bayar->id }}" class="btn btn-sm btn-success mb-1"><i class="fas fa-download"></i> Download Kwitansi</a>
          <p>Silahkan periksa seluruh riwayat pembayaran pada menu <a href="/riwayat-pembayaran">Riwayat Pembayaran</a></p>
        </div>
        @endif
        @endforeach





      </div>
    </div>
  </div>
</div>
</div>
<!-- Footer -->
@include('partials.footer')