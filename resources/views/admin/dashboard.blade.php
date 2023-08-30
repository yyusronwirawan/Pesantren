@include('admin.layouts.head')
<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">
    @include('admin.layouts.sidebar')
    <div class="layout-page">
      @include('admin.layouts.navbar')
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="card">
            <div class="d-flex align-items-end row">
              <div class="col-sm-7">
                <div class="card-body">
                  <h5 class="card-title text-primary">Selamat Datang {{auth()->user()->name}}</h5>
                  <p>Semoga harimu menyenangkan !</p>
                </div>
              </div>
              <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-4">
                  <img src="{!! asset('sneat/img/illustrations/man-with-laptop-light.png') !!}" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top:20px">
            <div class="col-lg-4 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="row" style="margin-top: 10px">
                    <div class="col-sm-6 text-center">
                      <span><i class="fas fa-users fa-4x"></i></span>
                    </div>
                    <div class="col-sm-5 text-center" style="margin-top: 10px">
                      <h4>{{ $akunAdmin }}</h4>
                      <p>
                      <h5>Admin</h5>
                      </p>
                    </div>
                  </div>
                </div>
                <a href="/data-akun" class="btn btn-primary"> Lihat Selengkapnya</a>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="row" style="margin-top: 10px">
                    <div class="col-sm-6 text-center">
                      <span><i class="fas fa-clipboard-user fa-4x"></i></span>
                    </div>
                    <div class="col-sm-5 text-center" style="margin-top: 10px">
                      <h4>{{ $akunSantri }}</h4>
                      <p>
                      <h5>Santri</h5>
                      </p>
                    </div>
                  </div>
                </div>
                <a href="/data-akun" class="btn btn-primary"> Lihat Selengkapnya</a>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="row" style="margin-top: 10px">
                    <div class="col-sm-5 text-center">
                      <span><i class="fas fa-wallet fa-4x"></i></span>
                    </div>
                    <div class="col-sm-6 text-center" style="margin-top: 10px">
                      <h4>{{ $akunPengurus }}</h4>
                      <p>
                      <h5>Pengurus</h5>
                      </p>
                    </div>
                  </div>
                </div>
                <a href="/data-akun" class="btn btn-primary"> Lihat Selengkapnya</a>
              </div>
            </div>

            <div class="col-lg-4 col-md-12 col-6 mb-4">
              <div class="card">
                <div class="card-body">
                  <div class="row" style="margin-top: 10px">
                    <div class="col-sm-6 text-center">
                      <span><i class="fas fa-id-card fa-4x"></i></span>
                    </div>
                    <div class="col-sm-5 text-center" style="margin-top: 10px">
                      <h4>{{ $akunPendidik }}</h4>
                      <p>
                      <h5>Pendidik</h5>
                      </p>
                    </div>
                  </div>
                </div>
                <a href="/data-akun" class="btn btn-primary"> Lihat Selengkapnya</a>
              </div>
            </div>

          </div>
        </div>
      </div>
      @include('admin.layouts.foot')
    </div>
  </div>
</div>