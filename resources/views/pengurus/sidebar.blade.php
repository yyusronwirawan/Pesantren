<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link collapsed" href="/dashboard-pengurus">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    @if (auth()->user()->level == "pengurus")
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Data Pembayaran</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a class="nav-link collapsed" href="/data-tagihan">
            <i class="bi-solid bi-wallet"></i><span>Data Tagihan</span>
          </a>
        </li>
        <li>
          <a class="nav-link collapsed" href="/data-pembayaran">
            <i class="bi-solid bi-wallet"></i><span>Laporan Pembayaran</span>
          </a>
        </li>
      </ul>
    </li>

    @endif
    @if (auth()->user()->level == "pendidik")
    <li class="nav-item">
      <a class="nav-link collapsed" href="santri">
        <i class="fas fa-user"></i><span>Data Santri</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="/data-nilai">
        <i class="bi bi-journal-text"></i><span>Nilai Santri</span>
      </a>
    </li>
    @endif
    @if (auth()->user()->level == "pengurus")
    <li class="nav-item">
      <a class="nav-link collapsed" href="/data-hafalan">
        <i class="bi bi-menu-button-wide"></i><span>Data Hafalan</span>
      </a>
    </li>
    @endif
    @if (auth()->user()->level == "pengurus")
    <li class="nav-item">
      <a class="nav-link collapsed" href="/data-informasi">
        <i class="fas fa-bullhorn"></i><span>Informasi Pribadi</span>
      </a>
    </li>
    @endif
    <li class="nav-heading">Fitur Lainnya</li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="akun-saya">
        <i class="bi bi-person"></i>
        <span>Profil</span>
      </a>
    </li>
  </ul>
</aside>