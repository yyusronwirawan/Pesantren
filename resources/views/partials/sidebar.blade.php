<div class="container-fluid page-body-wrapper ">
  <!-- partial:../../partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar" style="">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          <div class="nav-profile-image">
            <img src="{{ URL::to('/')}}/profil/{{ auth()->user()->foto }}" alt="profile">
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div>
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{ auth()->user()->name }}</span>
            <span class="text-secondary text-small">NIS : {{ auth()->user()->username }}</span>
          </div>
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dashboard">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#akademik" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Akademik</span>
          <i class="menu-arrow"></i>
          <i class="fas fa-book-reader menu-icon"></i>
        </a>
        <div class="collapse" id="akademik">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/jadwal">Jadwal Kegiatan</a></li>
            <li class="nav-item"> <a class="nav-link" href="/hafalan-santri">Capaian Santri</a></li>
            <li class="nav-item"> <a class="nav-link" href="/nilai">Rekap Nilai</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#pembayaran" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title">Pembayaran</span>
          <i class="menu-arrow"></i>
          <i class="fas fa-wallet menu-icon"></i>
        </a>
        <div class="collapse" id="pembayaran">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="/tagihan">Tagihan Pembayaran</a></li>
            <li class="nav-item"> <a class="nav-link" href="/riwayat-pembayaran">Riwayat Pembayaran</a></li>
            <li class="nav-item"> <a class="nav-link" href="/tutorial">Cara Pembayaran</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/info-santri">
          <span class="menu-title">Info Santri</span>
          <i class="fas fa-exclamation-circle menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/profil-user">
          <span class="menu-title">Pengaturan</span>
          <i class="fas fa-cogs menu-icon"></i>
        </a>
      </li>
    </ul>
  </nav>