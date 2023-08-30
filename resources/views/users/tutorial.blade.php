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
        </span> Cara Pembayaran
      </h3>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="accordion" id="accordionPanelsStayOpenExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                Video Tutorial
              </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
              <div class="accordion-body text-center">
                <div class='embed-container'>
                  <iframe width="500" height="300" src="https://www.youtube.com/embed/wOANoMCkOFo?feature=player_embedded?HD=1?rel=0?showinfo=0"></iframe>
                </div>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                Panduan Pembayaran
              </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
              <div class="accordion-body">
                <ol>
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

                  <li><b>VIA BANK TRANSFER</b></li>
                  <ul style="list-style-type: upper-alpha">
                    <ul style="list-style-type: upper-roman">
                      ~ <li>MANDIRI</li>
                      <ul style="list-style-type: upper-roman">
                        <li>ATM MANDIRI</li>
                        <ul>
                          <li>Pilih bayar/beli pada menu utama.</li>
                          <li>Pilih lainnya.</li>
                          <li>Pilih multi payment.</li>
                          <li>Masukkan kode perusahaan Midtrans <b>70012</b>.</li>
                          <li>Masukkan kode pembayaran, lalu konfirmasi.</li>
                          <li>Pembayaran selesai.</li>
                        </ul>
                        <li>Internet Banking</li>
                        <ul>
                          <li>Pilih bayar pada menu utama.</li>
                          <li>Pilih multi payment.</li>
                          <li>Pilih dari rekening.</li>
                          <li>Pilih Midtrans di bagian penyedia jasa.</li>
                          <li>Masukkan kode pembayaran, lalu konfirmasi.</li>
                          <li>Pembayaran selesai.</li>
                        </ul>
                      </ul>
                      <li>BNI</li>
                      <ul style="list-style-type: upper-roman">
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
                      <li>BRI</li>
                      <ul style="list-style-type: upper-roman">
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
                </ol>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
</div>
<!-- Footer -->
@include('partials.footer')