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
        </span> Detail Tagihan
      </h3>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover">
            @foreach($dataTagihan as $tagihan)
            <tr>
              <th>Nama Santri</th>
              <td>{{ auth()->user()->name }}</td>
            </tr>
            <tr>
              <th>Pembayaran</th>
              <td>{{ $tagihan->tagihan }}</td>
            </tr>
            <tr>
              <th>Nominal Pembayaran</th>
              <td>Rp. {{ number_format($tagihan->nominal) }}</td>
            </tr>
            <form action="/payment" id="submit_form" method="post">
              @csrf
              <input type="text" name="id" value="{{ $tagihan->id }}" hidden>
              <input type="text" name="bulan" id="bulan" value="{{ $tagihan->bulan }} " hidden>
              <input type="text" name="tagihan" id="tagihan" value="{{ $tagihan->tagihan }} " hidden>
              <input type="text" name="tahun" id="tahun" value="{{ $tagihan->tahun }} " hidden>

              <input type="text" name="json" id="json_callback" hidden>
            </form>
            @endforeach
          </table>
        </div>
        <div class="text-center mt-3">
          <button type="submit" class="btn btn-primary" id="pay-button">Bayar Sekarang</button>
        </div>


      </div>
    </div>
    <div class="page-bottom" style="margin: 20px">
      <br />

    </div>
  </div>

</div>

</div>

</div>

<!-- selesai content -->
<!-- Footer -->
<script type="text/javascript" src="https://app.midtrans.com/snap/snap.js" data-client-key="Mid-client-XMoUGIMR11cq2rPy"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script type="text/javascript">
  // For example trigger on button clicked, or any time you need
  var payButton = document.getElementById('pay-button');
  payButton.addEventListener('click', function() {
    // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
    window.snap.pay('{{$snap_token}}', {
      onSuccess: function(result) {
        /* You may add your own implementation here */
        alert("Pembayaran Berhasil !");
        console.log(result);
        send_response_to_form(result)
      },
      onPending: function(result) {
        /* You may add your own implementation here */
        alert("Menunggu Pembayaran !");
        console.log(result);
        send_response_to_form(result)
      },
      onError: function(result) {
        /* You may add your own implementation here */
        alert("Pembayaran Gagal !");
        console.log(result);
        send_response_to_form(result)
      },
      onClose: function() {
        /* You may add your own implementation here */
        alert('Menutup popup setelah selesai melakukan pembayaran!');
        send_response_to_form(result)
      }
    })
  });

  function send_response_to_form(result) {
    document.getElementById('json_callback').value = JSON.stringify(result);
    $('#submit_form').submit();
  }
</script>
@include('partials.footer')



</div>
</div>