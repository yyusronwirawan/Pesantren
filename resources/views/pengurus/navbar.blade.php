<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="{{ asset('NiceAdmin/') }}/assets/img/logo.jpg" alt="">
      <span class="d-none d-lg-block">AlMuntadhor</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->


  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item dropdown pe-3">

        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="{{ URL::to('/')}}/profil/{{ auth()->user()->foto }}" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>{{ auth()->user()->name }}</h6>
            <span>{{ auth()->user()->level }}</span>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="akun-saya">
              <i class="bi bi-person"></i>
              <span>Profile</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <hr class="dropdown-divider">
          </li>

          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{route('logout')}}">
              <i class="bi bi-box-arrow-right"></i>
              <span>Keluar</span>
            </a>
          </li>

        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->

</header><!-- End Header -->