<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="/dashboard"><img src="{{ URL::to('/')}}/content/{{ $setting->logo_aplikasi }}" alt="logo" height="200px" /></a>
    <a class="navbar-brand brand-logo-mini" href="/dashboard"><img src="{{ URL::to('/')}}/content/logo_mini.png" alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown">
        <a class="nav-link  @if ($notif_tagihan->isNotEmpty() or $notif_info->isNotEmpty()) count-indicator  @endif dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
          <i class="mdi mdi-bell-outline"></i>
          <span class="count-symbol bg-danger"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown" style="overflow:auto">
          <h6 class="p-3 mb-0">Notifikasi</h6>
          <div class="dropdown-divider"></div>
          @if ($notif_tagihan->isEmpty() && $notif_info->isEmpty())
          <div class="text-center">
            <small>Tidak ada notifikasi</small>
          </div>
          @endif
          @if ($notif_tagihan->isNotEmpty())
          @foreach ($notif_tagihan as $t)
          <a href="/tagihan" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-gradient-success">
                <i class="mdi mdi-wallet"></i>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject font-weight-normal mb-1">Tagihan Baru</h6>
              <p class="text-gray ellipsis mb-0"> <small>{{$t->tagihan}}</small></p>
            </div>
          </a>
          @endforeach
          @endif
          @if ($notif_info->isNotEmpty())
          @foreach ($notif_info as $info)
          <div class="dropdown-divider"></div>
          <a href="/info-santri" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-warning">
                <i class="fas fa-info-circle"></i>
              </div>
            </div>
            <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
              <h6 class="preview-subject font-weight-normal mb-1">Informasi Terbaru</h6>
              <p class="text-gray ellipsis mb-0"><small>{{$info->created_at}}</small></p>
            </div>
          </a>
          @endforeach
          @endif
        </div>
      </li>
      <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="nav-profile-img">
            <img src="{{ URL::to('/')}}/profil/{{ auth()->user()->foto }}" alt="image">
            <span class="availability-status online"></span>
          </div>
          <div class="nav-profile-text">
            <p class="mb-1 text-black">Hai, {{ auth()->user()->name }}</p>
          </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
          <a class="dropdown-item" href="/profil-user">
            <i class="fas fa-user me-2 text-success"></i> Profil </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{route('logout')}}">
            <i class="mdi mdi-logout me-2 text-primary"></i> Keluar </a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>