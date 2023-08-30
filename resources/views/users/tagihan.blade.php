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
        </span> Tagihan Pembayaran
      </h3>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="card-header mb-3">Tagihan Bulan Ini</div>
        <div class="list-group mb-4">
          @foreach($dataTagihan as $tagihan)
          @if ($tagihan->keterangan == 'pending')
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{ $tagihan->tagihan }}</h5>
            </div>
            <p class="mb-1 text-warning"><b>Rp. {{ number_format($tagihan->nominal) }}</b></p>
            <small class="badge bg-warning rounded">Pending</small>
            <form action="" method="post">
              @csrf
              <input type="text" name="tagihan" value="{{ $tagihan->tagihan }}" hidden>
              <input type="text" name="bulan" value="{{ $tagihan->bulan }}" hidden>
              <input type="text" name="tahun" value="{{ $tagihan->tahun }}" hidden>
              <input type="text" name="nominal" value="{{ $tagihan->nominal }}" hidden>
              <div class="text-center mt-2">
                <a href="/waiting-payment/{{ $tagihan->order_id }}" class="btn btn-gradient-success">Lanjutkan Pembayaran</a>
              </div>
            </form>
          </div>
          @else
          <div class="list-group-item">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{ $tagihan->tagihan }}</h5>
            </div>
            <p class="mb-1 text-danger"><b>Rp. {{ number_format($tagihan->nominal) }}</b></p>
            <small class="badge bg-danger rounded">Belum Lunas</small>
            <form action="" method="post">
              @csrf
              <input type="text" name="tagihan" value="{{ $tagihan->tagihan }}" hidden>
              <input type="text" name="bulan" value="{{ $tagihan->bulan }}" hidden>
              <input type="text" name="tahun" value="{{ $tagihan->tahun }}" hidden>
              <input type="text" name="nominal" value="{{ $tagihan->nominal }}" hidden>
              <div class="text-center mt-2">
                @if ($pending->isNotEmpty())
                <button type="button" class="form-control btn btn-gradient-success" data-bs-toggle="modal" data-bs-target="#DownloadDataPelajaran">
                  Bayar
                </button>
                @else
                <button type="submit" class=" form-control btn btn-gradient-success">Bayar</button>
                @endif

              </div>
            </form>
          </div>
          @endif

          @endforeach
        </div>
        <div class="accordion" id="accordionPanelsStayOpenExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                Tagihan Lainya
              </button>
            </h2>
            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
              <div class="accordion-body">
                <div class="list-group">
                  @foreach($dataTagihan2 as $tagihan2)
                  @if ($tagihan2->bulan != $waktu->isoFormat('MMMM') && $tagihan2->tahun == $tahun && $tagihan2->keterangan == 'pending')

                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{ $tagihan2->tagihan }}</h5>
                    </div>
                    <p class="mb-1 text-warning"><b>Rp. {{ number_format($tagihan->nominal) }}</b></p>
                    <small class="badge bg-warning rounded">Pending</small>
                    <form action="" method="post">
                      @csrf
                      <input type="text" name="tagihan" value="{{ $tagihan2->tagihan }}" hidden>
                      <input type="text" name="bulan" value="{{ $tagihan2->bulan }}" hidden>
                      <input type="text" name="tahun" value="{{ $tagihan2->tahun }}" hidden>
                      <input type="text" name="nominal" value="{{ $tagihan2->nominal }}" hidden>
                      <div class="text-center mt-2">
                        <a href="/waiting-payment/{{ $tagihan2->order_id }}" class="btn btn-gradient-success">Lanjutkan Pembayaran</a>
                      </div>
                    </form>
                  </div>
                  @endif
                  @if ($tagihan2->bulan != $waktu->isoFormat('MMMM') && $tagihan2->keterangan == 'Belum Lunas')
                  <div class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{ $tagihan2->tagihan }}</h5>
                    </div>
                    <p class="mb-1 text-danger"><b>Rp. {{ number_format($tagihan2->nominal) }}</b></p>
                    <small class="badge bg-danger rounded">Belum Lunas</small>
                    <form action="" method="post">
                      @csrf
                      <input type="text" name="tagihan" value="{{ $tagihan2->tagihan }}" hidden>
                      <input type="text" name="bulan" value="{{ $tagihan2->bulan }}" hidden>
                      <input type="text" name="tahun" value="{{ $tagihan2->tahun }}" hidden>
                      <input type="text" name="nominal" value="{{ $tagihan2->nominal }}" hidden>
                      <div class="text-center mt-2">
                        @if ($pending->isNotEmpty())
                        <button type="button" class="form-control btn btn-gradient-success" data-bs-toggle="modal" data-bs-target="#DownloadDataPelajaran">
                          Bayar
                        </button>
                        @else
                        <button type="submit" class=" form-control btn btn-gradient-success">Bayar</button>
                        @endif
                      </div>
                    </form>
                  </div>
                  @endif

                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>

</div>

<!-- Modal Download Perpelajaran-->
<div class="modal fade" id="DownloadDataPelajaran" tabindex="-1" aria-labelledby="DownloadDataPelajaranLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="DownloadDataPelajaranLabel">Peringatan!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Mohon maaf, masih terdapat tagihan berstatus <small class="badge bg-warning rounded">Pending</small></p>
        <p>Harap selesaikan pembayaran satu persatu!</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>

<!-- selesai content -->
<!-- Footer -->

@include('partials.footer')



</div>
</div>