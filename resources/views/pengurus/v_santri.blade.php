@extends('pengurus.main')
@section('pengurus')
@include('pengurus.navbar')
@include('pengurus.sidebar')

<main id="main" class="main">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Santri</h1>
        </div>
      </div>
    </div>
  </section>
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row" style="margin-left: 10px; margin-top:20px">
            <div class="table-responsive">
              <table class="table table-striped table-hover" style="vertical-align: middle">
                <tr>
                  <th>No.</th>
                  <th>NIS</th>
                  <th>Nama Santri</th>
                  <th>Kelas</th>
                  <th>Angkatan</th>
                </tr>
                @foreach($datas as $data)
                <tr>
                  <td>{{ $loop->index + 1 }}</td>
                  <td>{{ $data->username }}</td>
                  <td>{{ $data->name }}</td>
                  <td>{{ $data->kelas }}</td>
                  <td>{{ $data->angkatan }}</td>
                </tr>
                @endforeach
              </table>
              <div class="page-bottom" style="margin: 20px">
                <br>
                Current Page: {{ $datas->currentPage() }}<br>
                Jumlah Data: {{ $datas->total() }}<br>
                Data perhalaman: {{ $datas->perPage() }}<br>
                <br>
                {{ $datas->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@include('pengurus.footer')
@endsection