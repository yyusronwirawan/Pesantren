@extends('pengurus.main')
<!-- container -->
@section('pengurus')
<!-- Navbar -->
@include('pengurus.navbar')
<!-- Sidebar -->
@include('pengurus.sidebar')
<main id="main" class="main">
  <div class="card shadow">
    <div class="card-body">
      <div class="text-center display-4">
        Edit Pembayaran
      </div>
      <form method="POST" action="{{route('data-pembayaran.update', $colleges->id)}}">
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value="{{$colleges->id}}">
        <div class="mb-3">
          <label for="" class="form-label">NIS Santri</label>
          <input name="nis" value="{{$colleges->nis}}" type="text" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Nama Lengkap Santri</label>
          <input name="nama" value="{{$colleges->nama}}" type="text" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Tanggal Pembayaran</label>
          <input name="tanggal" value="{{$colleges->tanggal}}" type="date" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Tagihan Pembayaran</label>
          <input name="tagihan" value="{{$colleges->tagihan}}" type="text" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Nominal Pembayaran</label>
          <input name="nominal" value="{{$colleges->nominal}}" type="text" class="form-control" readonly>
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Bukti Pembayaran</label>
          <input name="bukti" value="{{$colleges->bukti}}" type="text" class="form-control" readonly>
        </div>
        <!-- <div class="mb-3">
                      <label for="" class="form-label">Keterangan</label>
                      <input name="keterangan" value="{{$colleges->keterangan}}" type="text" class="form-control" placeholder="Masukkan keterangan">
                    </div> -->
        <div>
          <label class="form-label">Keterangan</label>
          <!-- <td><input type="text" name="nominal" value="Rp. 350.000" class="form-control"readonly></td> -->
          <td class="mb-3">
            <select name="keterangan" class="form-select" aria-label="Default select example">
              <option hidden selected>{{$colleges->keterangan}}</option>
              <option value="Belum dikonfirmasi">Belum diverifikasi</option>
              <option value="Lunas">Lunas</option>
            </select>
          </td>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
    </div>
  </div>
</main>

@include('pengurus.footer')
@endsection