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
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Edit Mata Pelajaran</h4>
            <div class="card">
              <div class="card-body">
                <form method="POST" action="{{route('data-mapel.update', $mataPelajaran->id)}}">
                  @method('PUT')
                  @csrf
                  <input type="hidden" name="id" value="{{$mataPelajaran->id}}">
                  <div class="mb-3">
                    <label for="" class="form-label">Mata Pelajaran</label>
                    <input name="nama_mapel" value="{{$mataPelajaran->nama_mapel}}" type="text" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Nama Guru</label>
                    <input name="guru" value="{{$mataPelajaran->guru}}" type="text" class="form-control">
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>


        <!-- / Content -->
        @include('admin.layouts.foot')