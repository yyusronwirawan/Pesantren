@include('admin.layouts.head')

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      @include('admin.layouts.sidebar')
      <!-- Layout container -->
      <div class="layout-page">
        @include('admin.layouts.navbar')

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card">
              <div class="card-body">
                <form method="POST" action="{{route('data-prestasi.update', $prestasi->id)}}">
                  @method('PUT')
                  @csrf
                  <input type="hidden" name="id" value="{{$prestasi->id}}">
                  <div class="mb-3">
                    <label for="" class="form-label">Capaian Santri</label>
                    <input name="nama_prestasi" value="{{$prestasi->nama_prestasi}}" type="text" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Tingkatan</label>
                    <input name="tingkatan" value="{{$prestasi->tingkatan}}" type="text" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>


        <!-- / Content -->
        @include('admin.layouts.foot')