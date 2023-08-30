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
                <form method="POST" action="{{route('data-alumni.update', $others->id)}}">
                  @method('PUT')
                  @csrf
                  <input type="hidden" name="id" value="{{$others->id}}">
                  <div class="mb-3">
                    <label for="" class="form-label">Nama Lengkap</label>
                    <input name="nama" value="{{$others->nama}}" type="text" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Angkatan</label>
                    <input name="angkatan" value="{{$others->angkatan}}" type="text" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Alamay</label>
                    <input name="alamat" value="{{$others->alamat}}" type="text" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Telepon</label>
                    <input name="no_hp" value="{{$others->no_hp}}" type="text" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>


        <!-- / Content -->
        @include('admin.layouts.foot')